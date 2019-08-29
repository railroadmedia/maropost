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

    /**
     * @var test email address
     */
    public $testEmailAddress;

    public $testId;

    protected function setUp()
    {
        parent::setUp();

        $this->contactService = app()->make(ContactService::class);

        $this->testEmailAddress = 'roxana@drumeo.com';
        $this->testId = 430;
    }

    public function test_create()
    {
        $response = $this->contactService->createOrUpdate(
            new ContactVO('caleb+test1@drumeo.com', 'caleb', 'f', ['test_field' => 'hello'])
        );

        $this->assertEquals('caleb+test1@drumeo.com', $response['email']);
        $this->assertEquals('caleb', $response['first_name']);
        $this->assertEquals('f', $response['last_name']);
    }

    public function test_update()
    {
        $response = $this->contactService->createOrUpdate(
            new ContactVO('caleb+test1@drumeo.com', 'caleb', 'favor')
        );

        $this->assertEquals('favor', $response['last_name']);
    }

    public function test_find_one_by_email()
    {
        $response = $this->contactService->findOneByEmail($this->testEmailAddress);

        $this->assertNotNull($response);
        $this->assertEquals($this->testEmailAddress, $response['email']);
    }

    public function test_find_one_by_id()
    {
        $response = $this->contactService->findOneById(430);

        $this->assertNotNull($response);
        $this->assertEquals($this->testEmailAddress, $response->email);
    }

    public function test_find_one_by_id_not_existing()
    {
        $response = $this->contactService->findOneById(rand(9999,999999));

        $this->assertNull($response);
    }

    public function test_delete_contact_by_email()
    {
        $response = $this->contactService->deleteContactByEmail($this->testEmailAddress);

        $this->assertEmpty($response['list_subscriptions']);
    }

    public function test_add_tags_to_contact()
    {
        $response = $this->contactService->addTagsToContact(
            $this->testId,
            ['Guitareo - Customer - Member - Active','Drumeo - Customers - Members']
        );

        $this->assertNotEmpty($response['tags']);
        $this->assertEquals(2, count($response['tags']));
    }

    public function test_remove_tags_from_contact()
    {
        $response = $this->contactService->removeTagsFromContact(
            $this->testId,
            ['Guitareo - Customer - Member - Active','Drumeo - Customers - Members']
        );

        $this->assertEmpty($response['tags']);
    }

    public function test_add_inexistent_tags_to_contact()
    {
        $response = $this->contactService->addTagsToContact(
            $this->testId,
            [$this->faker->word,$this->faker->word]
        );

        $this->assertEmpty($response['tags']);
    }

    public function test_add_contact_to_lists()
    {
        $response = $this->contactService->addContactToLists([1],
            $this->testId
        );

        $this->assertNotEmpty($response['list_subscriptions']);
    }

    public function test_pull_list_contacts()
    {
        $response = $this->contactService->getListContacts(1);

        $this->assertNotEmpty($response);
    }

    public function test_remove_contact_from_list()
    {
        $this->contactService->addContactToLists([1],
            $this->testId
        );

        $response = $this->contactService->removeContactFromLists([1],
            $this->testId
        );

        $this->assertEquals('Unsubscribed', $response['list_subscriptions'][0]['status']);
    }

}