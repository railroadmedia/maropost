<?php

namespace Railroad\Maropost\Tests\Integration;

use Railroad\Maropost\Services\ContactService;
use Railroad\Maropost\Tests\TestCase;
use Railroad\Maropost\ValueObjects\ContactVO;

class ContactServiceTest extends TestCase
{
    /**
     * @var ContactService
     */
    public $contactService;

    protected function setUp()
    {
        parent::setUp();

        $this->contactService = app()->make(ContactService::class);
    }

    public function test_create()
    {
        $response = $this->contactService->create(
            new ContactVO('caleb+test1@drumeo.com', 'caleb', 'f', ['test_field' => 'hello'])
        );

        dd($response);
    }
}