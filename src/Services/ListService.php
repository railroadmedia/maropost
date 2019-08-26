<?php

namespace Railroad\Maropost\Services;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Railroad\Maropost\Gateways\MaropostGateway;
use Railroad\Maropost\ValueObjects\ListVO;
use stdClass;

class ListService
{
    /**
     * @var MaropostGateway
     */
    private $maropostGateway;

    /**
     * ListService constructor.
     *
     * @param MaropostGateway $maropostGateway
     */
    public function __construct(MaropostGateway $maropostGateway)
    {
        $this->maropostGateway = $maropostGateway;
    }

    /**
     * @param bool $noCounts - set true to get description of lists other than counts, for faster results
     * @return array
     */
    public function index($noCounts = false)
    {
        return $this->maropostGateway->get('lists', ['no_counts' => $noCounts]);
    }

    /**
     * @param ListVO $list
     * @return array|mixed|object
     * @throws GuzzleException
     */
    public function create(ListVO $list)
    {
        try {
            $list = $this->maropostGateway->post('lists', ['list' => $list->toArray()]);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }
        return $list;
    }

    /**
     * @param $id
     * @param ListVO $list
     * @return array
     * @throws Exception
     */
    public function update($id, ListVO $list)
    {
        try {
            return $this->maropostGateway->put('lists/' . $id, ['list' => $list->toArray()]);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     */
    public function delete($id)
    {
        try {
            return $this->maropostGateway->delete('lists/' . $id);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }
    }

    /**
     * @param $id
     * @return array|mixed|object|stdClass
     * @throws Exception
     */
    public function show($id)
    {
        try {
            return $this->maropostGateway->get('lists/' . $id);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }
    }
}