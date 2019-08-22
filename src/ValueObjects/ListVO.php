<?php

namespace Railroad\Maropost\ValueObjects;

class ListVO
{
    public $accountId;
    public $addToUnsubscribePage;
    public $address;
    public $contactsCount;
    public $fromEmail;
    public $fromName;
    public $hardBounces;
    public $id;
    public $language;
    public $name;
    public $displayName;
    public $description;
    public $postUrl;
    public $refreshedAt;
    public $replyToEmail;
    public $softBounces;
    public $subscribers;
    public $unsubscribers;
    public $complaintsCount;
    public $updatedAt;
    public $totalContactsCount;
    public $totalPages;

    /**
     * ListVO constructor.
     *
     * @param $name
     * @param string $replyToEmail
     * @param string $address
     * @param $fromEmail
     * @param $language
     * @param $fromName
     * @param $addToUnsubscribePage
     * @param $postUrl
     * @param $displayName
     * @param $description
     */
    public function __construct(
        $name,
        $address,
        $language,
        $fromEmail = '',
        $replyToEmail = '',
        $fromName = '',
        $addToUnsubscribePage = false,
        $postUrl = '',
        $displayName = '',
        $description = ''
    ) {
        $this->name = $name;
        $this->replyToEmail = $replyToEmail;
        $this->address = $address;
        $this->fromEmail = $fromEmail;
        $this->language = $language;
        $this->fromName = $fromName;
        $this->addToUnsubscribePage = $addToUnsubscribePage;
        $this->postUrl = $postUrl;
        $this->displayName = $displayName;
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [

            'name' => $this->name,
            'reply_to_email' => $this->replyToEmail,
            'address' => $this->address,
            'from_email' => $this->fromEmail,
            'language' => $this->language,
            'from_name' => $this->fromName,
            'add_to_unsubscribe_page' => $this->addToUnsubscribePage,
            'post_url' => $this->postUrl,
            'display_name' => $this->displayName,
            'description' => $this->description,
        ];
    }
}