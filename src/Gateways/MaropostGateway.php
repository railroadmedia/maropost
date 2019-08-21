<?php

namespace Railroad\Maropost\Gateways;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class MaropostGateway
{
    /**
     * @var Client
     */
    private $client;

    public static $debug = false;

    /**
     * MaropostGateway constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        if (!config('maropost.account_id')) {
            throw new \Exception("Maropost account ID is required.");
        }
        if (!config('maropost.auth_token')) {
            throw new \Exception("Maropost auth token is required.");
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
     * @param string $target The URI target that will be added to the base url
     * @param array $params The query string and values structured as an array
     * @return \stdClass          What Maropost returns as an object structure
     */
    public function get($target, $params = [])
    {
        // Try to get a response from Maropost API using Guzzle Client
        try {
            $response = $this->client->get($target, ['json' => $params]);

            // If successful, return an object that decodes the returned JSON
            return json_decode($response->getBody());
        } catch (ClientException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Function to perform POST method on $target URI with $params as JSON body
     *
     * @param string $target The URI target that will be added to the base url
     * @param array $params The query string and values structured as an array
     * @return array|mixed|object   What Maropost returns as an object structure
     * @throws GuzzleException
     */
    public function post($target, $params = [])
    {
        try {
            $response = $this->client->request(
                'POST',
                $target,
                [
                    'json' => $params,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'debug' => self::$debug,
                ]
            );
            return json_decode($response->getBody());
        } catch (ClientException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Function to perform PUT method on $target URI with $params as JSON body
     *
     * @param string $target The URI target that will be added to the base url
     * @param array $params The query string and values structured as an array
     * @return array          What Maropost returns as an array structure
     */
    public function put($target, $params = [])
    {
        try {
            $response = $this->client->put(
                $target,
                [
                    'json' => $params,
                    'headers' => [
                        'Accept' => 'application/json',
                    ],
                    'debug' => self::$debug,
                ]
            );
            return json_decode($response->getBody());
        } catch (ClientException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Function to perform DELETE method on $target URI with $params as query parameters
     *
     * @param string $target The URI target that will be added to the base url
     * @param array $params The query string and values structured as an array
     * @return array          What Maropost returns as an array structure
     */
    public function delete($target, $params = [])
    {
        try {
            $response = $this->client->delete($target, ['json' => $params]);

            return json_decode($response->getBody());
        } catch (ClientException $e) {
            return $this->handleException($e);
        }
    }

    /**
     * Function to handle exceptions caught in the request methods
     *
     * @param object $exception [description]
     * @return array
     */
    private function handleException($exception)
    {
        // Check if the Exception has a response
        if ($exception->hasResponse()) {
            // Use the exception response to a build an array to return
            // with the status code (so at least we have something)
            $response = $exception->getResponse();
            $status = $response->getStatusCode();
            return ['status' => $status, 'message' => $exception->getMessage()];
        } else {
            return ['status' => 404];
        }
    }

}