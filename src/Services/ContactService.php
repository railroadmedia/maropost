<?php

namespace Railroad\Maropost\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Railroad\Maropost\ValueObjects\ContactVO;

class ContactService
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $authToken;

    /**
     * ContactService constructor.
     */
    public function __construct()
    {
        $this->authToken = config('maropost.auth_token');
        $this->guzzleClient = new Client(
            [
                'base_uri' => config('maropost.base_api_url').config('maropost.account_id').'/',
            ]
        );
    }

    /**
     * @param  ContactVO  $contact
     *
     * @throws GuzzleException
     * @return mixed
     */
    public function createOrUpdate(ContactVO $contact)
    {
        return json_decode(
            $this->guzzleClient->request(
                'POST',
                'contacts',
                [
                    'json' => ['contact' => $contact->toArray()],
                    'query' => [
                        'auth_token' => config('maropost.auth_token'),
                    ],
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                ]
            )->getBody()
        );
    }

    /**
     * @param $email
     *
     * @throws GuzzleException
     * @return mixed
     */
    public function findOneByEmail($email)
    {
        return json_decode(
            $this->guzzleClient->request(
                'GET',
                'contacts/email',
                [
                    'query' => [
                        'auth_token' => config('maropost.auth_token'),
                        'contact' => ['email' => $email],
                    ],
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                ]
            )->getBody()
        );
    }
}