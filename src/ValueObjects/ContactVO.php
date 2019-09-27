<?php

namespace Railroad\Maropost\ValueObjects;

class ContactVO
{
    public $email;
    public $firstName;
    public $lastName;
    public $customFields = [];
    public $tagsToAdd = [];
    public $tagsToRemove = [];
    public $subscribeListIds = [];
    public $unsubscribeListIds = [];

    /**
     * ContactVO constructor.
     *
     * @param $email
     * @param string $firstName
     * @param string $lastName
     * @param array $customFields
     * @param array $tagsToAdd
     * @param array $tagsToRemove
     * @param array $subscribeListIds
     * @param array $unsubscribeListIds
     */
    public function __construct(
        $email,
        $firstName = null,
        $lastName = null,
        array $customFields = [],
        array $tagsToAdd = [],
        array $tagsToRemove = [],
        array $subscribeListIds = [],
        array $unsubscribeListIds = []
    ) {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->customFields = $customFields;
        $this->tagsToAdd = $tagsToAdd;
        $this->tagsToRemove = $tagsToRemove;
        $this->subscribeListIds = $subscribeListIds;
        $this->unsubscribeListIds = $unsubscribeListIds;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [
            'email' => $this->email,
            'custom_field' => $this->customFields,
            'add_tags' => $this->tagsToAdd,
            'remove_tags' => $this->tagsToRemove,
        ];

        if ($this->firstName !== null) {
            $array['first_name'] = $this->firstName;
        }

        if ($this->lastName !== null) {
            $array['last_name'] = $this->lastName;
        }

        $array['options'] = [
            'subscribe_list_ids' => implode(',', $this->subscribeListIds),
            'unsubscribe_list_ids' => implode(',', $this->unsubscribeListIds),
        ];

        return $array;
    }
}