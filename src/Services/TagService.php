<?php

namespace Railroad\Maropost\Services;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Railroad\Maropost\Gateways\MaropostGateway;
use Railroad\Maropost\ValueObjects\TagVO;

class TagService
{
    /**
     * @var MaropostGateway
     */
    private $maropostGateway;

    /**
     * TagService constructor.
     *
     * @param MaropostGateway $maropostGateway
     */
    public function __construct(MaropostGateway $maropostGateway)
    {
        $this->maropostGateway = $maropostGateway;
    }

    /**
     * @param TagVO $tag
     * @return array|mixed|object
     * @throws GuzzleException
     */
    public function create(TagVO $tag)
    {
        try {
            $task = $this->maropostGateway->post("tags", ['tag' => $tag->toArray()]);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }
        return $task;
    }

    /**
     * @param $name
     * @return array|mixed|object|\stdClass|null
     */
    public function findByName($name)
    {
        try {
            $task = $this->maropostGateway->get("tags", ['name' => $name]);
        } catch (ClientException $e) {
            $task = null;
        }

        return $task;
    }

    /**
     * @param $id
     * @return array|mixed|object|\stdClass|null
     */
    public function findById($id)
    {
        try {
            $task = $this->maropostGateway->get("tag/" . $id);
        } catch (ClientException $e) {
            $task = null;
        }

        return $task;
    }

    /**
     * @param $id
     * @return array|mixed|object
     * @throws Exception
     */
    public function delete($id)
    {
        try {
            return $this->maropostGateway->delete('tags/' . $id);
        } catch (ClientException $e) {
            $responseBodyAsString =
                $e->getResponse()
                    ->getBody()
                    ->getContents();
            throw new Exception($responseBodyAsString);
        }
    }

    /**
     * @return array|mixed|object|\stdClass
     */
    public function index()
    {
        return  $this->maropostGateway->get("tags");
    }

}