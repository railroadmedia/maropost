<?php

namespace Railroad\Maropost\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Railroad\Maropost\Gateways\MaropostGateway;
use Railroad\Maropost\ValueObjects\ContactVO;
use Railroad\Maropost\ValueObjects\ListVO;

class ListService
{
    /**
     * @var Client
     */
    private $guzzleClient;

    /**
     * @var string
     */
    private $authToken;

    private $maropostGateway;

    /**
     * ContactService constructor.
     */
    public function __construct(MaropostGateway $maropostGateway)
    {
        $this->authToken = config('maropost.auth_token');
        $this->guzzleClient = new Client(
            [
                'base_uri' => config('maropost.base_api_url').config('maropost.account_id').'/',
            ]
        );

        $this->maropostGateway = $maropostGateway;
    }

    /**
     * @param ListVO $list
     * @return array|mixed|object
     * @throws GuzzleException
     */
    public function create(ListVO $list)
    {
         return $this->maropostGateway->post('lists',['list' => $list->toArray()]);
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