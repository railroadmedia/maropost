<?php

namespace Railroad\Maropost\Services;

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
        return $this->maropostGateway->get("contacts/email", ['contact' => ['email' => $email]]);
    }

    /**
     * @param $id
     * @return stdClass
     */
    public function findOneById($id)
    {
        $contact = null;

        $lists = $this->maropostGateway->get("lists", ['no_counts' => true]);

        foreach($lists as $list){
            $contact = $this->maropostGateway->get("lists/".$list->id."/contacts/".$id);
            if($contact instanceof stdClass){
                return $contact;
            }
        }

        return $contact;
    }

    /**
     * @param $email
     * @return array
     */
    public function deleteContactByEmail($email)
    {
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
        $contact->subscribeListIds = $listIds;

        $this->maropostGateway->post("contacts", ['contact' => $contact->toArray()]);

        return $this->findOneByEmail($contact->email);
    }

    /**
     * @param array $listIds
     * @param ContactVO $contact
     * @throws GuzzleException
     */
    public function removeContactFromLists(array  $listIds, ContactVO $contact)
    {
        $contact->unsubscribeListIds = $listIds;

        $this->maropostGateway->post("contacts", ['contact' => $contact->toArray()]);

        return $this->findOneByEmail($contact->email);
    }
}