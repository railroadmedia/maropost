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
        $response = $this->contactService->createOrUpdate(
            new ContactVO('caleb+test1@drumeo.com', 'caleb', 'f', ['test_field' => 'hello'])
        );

        $this->assertEquals('caleb+test1@drumeo.com', $response->email);
        $this->assertEquals('caleb', $response->first_name);
        $this->assertEquals('f', $response->last_name);
    }

    public function test_update()
    {
        $response = $this->contactService->createOrUpdate(
            new ContactVO('caleb+test1@drumeo.com', 'caleb', 'favor')
        );

        $this->assertEquals('favor', $response->last_name);
    }

    public function test_find_one_by_email()
    {
        $response = $this->contactService->findOneByEmail('roxana@drumeo.com');

        $this->assertNotNull($response);
        $this->assertEquals('roxana@drumeo.com', $response->email);
    }

    public function _test_find_one_by_id()
    {
        $response = $this->contactService->findOneById(430);

        $this->assertNotNull($response);
        $this->assertEquals('roxana@drumeo.com', $response->email);
    }

    public function test_delete_contact_by_email()
    {
        $response = $this->contactService->deleteContactByEmail('roxana@drumeo.com');

        $this->assertNull($response);
    }

    public function test_add_tags_to_contact()
    {
        $response = $this->contactService->addTagsToContact(
            new ContactVO('roxana@drumeo.com'),
            ['test_tag','test_tag13']
        );
        $response = $this->contactService->findOneByEmail('roxana@drumeo.com');

        $this->assertNotEmpty($response->tags);
        $this->assertEquals(2, count($response->tags));
    }

    public function test_remove_tags_from_contact()
    {
        $response = $this->contactService->removeTagsFromContact(
            new ContactVO('roxana@drumeo.com'),
            ['test_tag','test_tag13']
        );
        $response = $this->contactService->findOneByEmail('roxana@drumeo.com');

        $this->assertEmpty($response->tags);
    }

}