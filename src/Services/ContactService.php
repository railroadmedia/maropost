<?php

namespace Railroad\Maropost\Services;

use GuzzleHttp\Exception\GuzzleException;
use Railroad\Maropost\Gateways\MaropostGateway;
use Railroad\Maropost\ValueObjects\ContactVO;
use Railroad\Maropost\ValueObjects\TagVO;

class ContactService
{
    /**
     * @var MaropostGateway
     */
    private $maropostGateway;

    /**
     * ContactService constructor.
     *
     * @param MaropostGateway $maropostGateway
     */
    public function __construct(MaropostGateway $maropostGateway)
    {
        $this->maropostGateway = $maropostGateway;
    }

    /**
     * @param ContactVO $contact
     * @return array|mixed|object
     * @throws GuzzleException
     */
    public function createOrUpdate(ContactVO $contact)
    {
        return $this->maropostGateway->post("contacts", ['contact' => $contact->toArray()]);
    }

    /**
     * @param $email
     * @return \stdClass
     */
    public function findOneByEmail($email)
    {
        return $this->maropostGateway->get("contacts/email", ['contact' => ['email' => $email]]);
    }

    /**
     * @param $id
     * @return \stdClass
     */
    public function findOneById($id)
    {
        return $this->maropostGateway->get("contacts/email", ['contact' => ['id' => $id]]);
    }

    /**
     * @param $email
     * @return array
     */
    public function deleteContactByEmail($email)
    {
        return $this->maropostGateway->delete('contacts/delete_all', ['contact' => ['email' => $email]]);
    }

    /**
     * @param ContactVO $contact
     * @param array $tags
     * @return \stdClass
     * @throws GuzzleException
     */
    public function addTagsToContact(ContactVO $contact, array $tags)
    {
        $contact->tagsToAdd = $tags;

        $this->maropostGateway->post("contacts", ['contact' => $contact->toArray()]);

        return $this->findOneByEmail($contact->email);
    }

    /**
     * @param ContactVO $contact
     * @param array $tags
     * @return \stdClass
     * @throws GuzzleException
     */
    public function removeTagsFromContact(ContactVO $contact, array $tags)
    {
        $contact->tagsToRemove = $tags;

        $this->maropostGateway->post("contacts", ['contact' => $contact->toArray()]);

        return $this->findOneByEmail($contact->email);
    }

}