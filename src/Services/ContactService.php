<?php

namespace Railroad\Maropost\Services;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Railroad\Maropost\Gateways\MaropostGateway;
use Railroad\Maropost\ValueObjects\ContactVO;
use stdClass;

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

    /** Pull list contacts
     *
     * @return stdClass
     */
    public function getListContacts($listId)
    {
        return $this->maropostGateway->get("lists/" . $listId . "/contacts");
    }

    /**
     * @param $email
     * @return stdClass
     */
    public function findOneByEmail($email)
    {
        try {
            return $this->maropostGateway->get("contacts/email", ['contact' => ['email' => $email]]);
        } catch (ClientException $e) {
            return null;
        }
    }

    /**
     * @param $id
     * @return stdClass
     */
    public function findOneById($id)
    {
        try {
            return $this->maropostGateway->get("contacts/" . $id);
        } catch (ClientException $e) {
            return null;
        }
    }

    /**
     * @param $email
     * @return stdClass
     * @throws Exception
     */
    public function deleteContactByEmail($email)
    {
        try {
            $this->findOneByEmail($email);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }

        $this->maropostGateway->delete('contacts/delete_all', ['contact' => ['email' => $email]]);

        return $this->findOneByEmail($email);
    }

    /**
     * @param ContactVO $contact
     * @param array $tags
     * @return stdClass
     * @throws GuzzleException
     */
    public function addTagsToContact(ContactVO $contact, array $tags)
    {
        try {
            $this->findOneByEmail($contact->email);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }

        $contact->tagsToAdd = $tags;

        $this->maropostGateway->post("contacts", ['contact' => $contact->toArray()]);

        return $this->findOneByEmail($contact->email);
    }

    /**
     * @param ContactVO $contact
     * @param array $tags
     * @return stdClass
     * @throws GuzzleException
     */
    public function removeTagsFromContact(ContactVO $contact, array $tags)
    {
        try {
            $this->findOneByEmail($contact->email);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }
        $contact->tagsToRemove = $tags;

        $this->maropostGateway->post("contacts", ['contact' => $contact->toArray()]);

        return $this->findOneByEmail($contact->email);
    }

    /**
     * @param array $listIds
     * @param ContactVO $contact
     * @return stdClass
     * @throws GuzzleException
     */
    public function addContactToLists(array $listIds, ContactVO $contact)
    {
        try {
            $this->findOneByEmail($contact->email);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }

        $contact->subscribeListIds = $listIds;

        $this->maropostGateway->post("contacts", ['contact' => $contact->toArray()]);

        return $this->findOneByEmail($contact->email);
    }

    /**
     * @param array $listIds
     * @param ContactVO $contact
     * @return stdClass
     * @throws GuzzleException
     */
    public function removeContactFromLists(array $listIds, ContactVO $contact)
    {
        try {
            $this->findOneByEmail($contact->email);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }

        $contact->unsubscribeListIds = $listIds;

        $this->maropostGateway->post("contacts", ['contact' => $contact->toArray()]);

        return $this->findOneByEmail($contact->email);
    }
}