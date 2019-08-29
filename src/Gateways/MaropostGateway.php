<?php

namespace Railroad\Maropost\Gateways;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class MaropostGateway
{
    /**
     * @var Client
     */
    private $client;

    /**
     * MaropostGateway constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        if (!config('maropost.account_id')) {
            throw new Exception("Maropost account ID is required.");
        }
        if (!config('maropost.auth_token')) {
            throw new Exception("Maropost auth token is required.");
        }

        $args = [
            'base_uri' => config('maropost.base_api_url') . config('maropost.account_id') . '/',
            'query' => ['auth_token' => config('maropost.auth_token')],
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ];

        // Create HTTP Client with some default options
        $this->client = new Client($args);
    }

    /**
     * Function to perform GET method on $target URI with $params as json parameters
     *
     * @param $target The URI target that will be added to the base url
     * @param array $params The query string and values structured as an array
     * @return array|mixed|object
     */
    public function get($target, $params = [])
    {
        $response = $this->client->get($target, ['json' => $params]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Function to perform POST method on $target URI with $params as JSON body
     *
     * @param string $target The URI target that will be added to the base url
     * @param array $params The query string and values structured as an array
     * @return array|mixed|object   What Maropost returns
     */
    public function post($target, $params = [])
    {
        $response = $this->client->post($target, ['json' => $params,]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Function to perform PUT method on $target URI with $params as JSON body
     *
     * @param string $target The URI target that will be added to the base url
     * @param array $params The query string and values structured as an array
     * @return array          What Maropost returns
     */
    public function put($target, $params = [])
    {
        $response = $this->client->put($target, ['json' => $params,]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Function to perform DELETE method on $target URI with $params as query parameters
     *
     * @param $target The URI target that will be added to the base url
     * @param array $params The query string and values structured as an array
     * @return array|mixed|object What Maropost returns
     */
    public function delete($target, $params = [])
    {
        $response = $this->client->delete($target, ['json' => $params]);

        return json_decode($response->getBody(), true);
    }
}