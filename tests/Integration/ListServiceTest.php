<?php

namespace Railroad\Maropost\Tests\Integration;

use Railroad\Maropost\Services\ListService;
use Railroad\Maropost\Tests\TestCase;
use Railroad\Maropost\ValueObjects\ListVO;

class ListServiceTest extends TestCase
{
    /**
     * @var ListService
     */
    public $listService;

    protected function setUp()
    {
        parent::setUp();

        $this->listService = app()->make(ListService::class);
    }

    public function test_index_with_count()
    {
        $response = $this->listService->index();

        $this->assertNotEmpty($response);

        //assert count data returned for each list
        foreach ($response as $list)
        {
            $this->assertTrue(array_key_exists('total_contacts_count', $list));
        }
    }

    public function test_index_without_count()
    {
        $response = $this->listService->index(true);

        $this->assertNotEmpty($response);

        //assert count data returned for each list
        foreach ($response as $list)
        {
            $this->assertFalse(array_key_exists('total_contacts_count', $list));
        }
    }

    public function test_create()
    {
        $list = new ListVO($this->faker->word, $this->faker->address, $this->faker->languageCode);
        $response = $this->listService->create($list);

        $this->assertEquals($list->name, $response['name']);
        $this->assertEquals($list->address, $response['address']);
        $this->assertEquals($list->language, $response['language']);
    }

    public function test_update()
    {
        $newList = new ListVO('test', $this->faker->address, $this->faker->languageCode);
        $response = $this->listService->update(1, $newList);

        $this->assertEquals($newList->name, $response['name']);
        $this->assertEquals($newList->address, $response['address']);
        $this->assertEquals($newList->language, $response['language']);
    }

    public function test_show()
    {
        $response = $this->listService->show(1);

        $this->assertNotNull($response);
        $this->assertEquals(1, $response['id']);
    }

    public function test_delete()
    {
        $listVO = new ListVO($this->faker->word, $this->faker->address, $this->faker->languageCode);
        $list = $this->listService->create($listVO);

        $response = $this->listService->delete($list['id']);

        $this->assertNull($response);
    }

}