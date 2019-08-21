<?php

namespace Railroad\Maropost\Services;


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
        return $this->maropostGateway->post("tags", ['tag' => $tag->toArray()]);
    }

    /**
     * @param $name
     *
     * @throws GuzzleException
     * @return mixed
     */
    public function findByName($name)
    {
        return $this->maropostGateway->get("tags", ['tags' => ['name' => $name]]);
    }

    /**
     * @param $id
     * @return array|mixed|object
     * @throws GuzzleException
     */
    public function findById($id)
    {
        return $this->maropostGateway->get("tag/".$id);
    }

    /**
     * @param $id
     * @return array|mixed|object
     * @throws GuzzleException
     */
    public function delete($id)
    {
        return $this->maropostGateway->delete('tags/'.$id);
    }

}