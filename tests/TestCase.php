<?php

namespace Railroad\Maropost\Tests;

use Carbon\Carbon;
use Exception;
use Faker\Generator;
use Illuminate\Contracts\Events\Dispatcher;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Railroad\Maropost\Providers\MaropostServiceProvider;

class TestCase extends BaseTestCase
{
    /**
     * @var Generator
     */
    protected $faker;

    protected function setUp()
    {
        parent::setUp();

        $this->faker = $this->app->make(Generator::class);

        Carbon::setTestNow(Carbon::now());
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {


        $app->register(MaropostServiceProvider::class);
    }

    /**
     * We don't want to use mockery so this is a reimplementation of the mockery version.
     *
     * @param  array|string  $events
     *
     * @throws \Exception
     * @return $this
     *
     */
    public function expectsEvents($events)
    {
        $events = is_array($events) ? $events : func_get_args();
        $mock = $this->getMockBuilder(Dispatcher::class)->setMethods(['fire', 'dispatch'])->getMockForAbstractClass();
        $mock->method('fire')->willReturnCallback(
            function ($called) {
                $this->firedEvents[] = $called;
            }
        );
        $mock->method('dispatch')->willReturnCallback(
            function ($called) {
                $this->firedEvents[] = $called;
            }
        );
        $this->app->instance('events', $mock);
        $this->beforeApplicationDestroyed(
            function () use ($events) {
                $fired = $this->getFiredEvents($events);
                if ($eventsNotFired = array_diff($events, $fired)) {
                    throw new Exception(
                        'These expected events were not fired: ['.implode(', ', $eventsNotFired).']'
                    );
                }
            }
        );

        return $this;
    }
}