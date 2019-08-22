<?php

namespace Railroad\Maropost\Tests\Integration;

use Railroad\Maropost\Services\TagService;
use Railroad\Maropost\Tests\TestCase;
use Railroad\Maropost\ValueObjects\TagVO;

class TagServiceTest extends TestCase
{
    /**
     * @var TagService
     */
    public $tagService;

    protected function setUp()
    {
        parent::setUp();

        $this->tagService = app()->make(TagService::class);
    }

    public function test_create()
    {
        $tagName = $this->faker->word;
        $response = $this->tagService->create(
            new TagVO($tagName)
        );

        $this->assertEquals($tagName, $response->name);
    }

    public function test_get_tag_by_name()
    {
        $response = $this->tagService->findByName('test_tag');

        $this->assertEquals('test_tag', $response[0]->name);
    }

    public function test_delete()
    {
        $tag = $this->tagService->create(
            new TagVO($this->faker->word)
        );
        $response = $this->tagService->delete($tag->id);

        $this->assertNull($response);
    }

}