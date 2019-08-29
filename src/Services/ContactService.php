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

    /**
     * @param $contactId
     * @param ContactVO $contact
     * @return array
     */
    public function update($contactId, ContactVO $contact)
    {
        return $this->maropostGateway->put("contacts/".$contactId, ['contact' => $contact->toArray()]);
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
     * @return array|mixed|object|stdClass|null
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
     * @return ContactVO|null
     */
    public function findOneById($id)
    {
        try {
            $contact = $this->maropostGateway->get("contacts/" . $id);

            return new ContactVO(
                $contact['email'],
                $contact['first_name'],
                $contact['last_name']
            );
        } catch (ClientException $e) {
            return null;
        }
    }

    /**
     * @param $email
     * @return array|mixed|object|stdClass|null
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
     * @param $contactId
     * @param array $tags
     * @return array|mixed|object|stdClass|null
     * @throws GuzzleException
     */
    public function addTagsToContact($contactId, array $tags)
    {
        try {
            $contact = $this->findOneById($contactId);
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
     * @param $contactId
     * @param array $tags
     * @return array|mixed|object|stdClass|null
     * @throws GuzzleException
     */
    public function removeTagsFromContact($contactId, array $tags)
    {
        try {
            $contact = $this->findOneById($contactId);
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
     * @param $contactId
     * @return array|mixed|object|stdClass|null
     * @throws GuzzleException
     */
    public function addContactToLists(array $listIds, $contactId)
    {
        try {
            $contact = $this->findOneById($contactId);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }

        $this->maropostGateway->post("contacts", ['contact' => array_merge(
            $contact->toArray(),
            [
                'options' => [
                    'subscribe_list_ids' => implode(',', $listIds)
                ],
            ]
        )]);

        return $this->findOneByEmail($contact->email);
    }

    /**
     * @param array $listIds
     * @param $contactId
     * @return array|mixed|object|stdClass|null
     * @throws GuzzleException
     */
    public function removeContactFromLists(array $listIds, $contactId)
    {
        try {
            $contact = $this->findOneById($contactId);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }

        $this->maropostGateway->post("contacts", ['contact' => array_merge(
            $contact->toArray(),
            [
                'options' => [
                    'unsubscribe_list_ids' => implode(',', $listIds),
                ],
            ]
        )]);

        return $this->findOneByEmail($contact->email);
    }
}