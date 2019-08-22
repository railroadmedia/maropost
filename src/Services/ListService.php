<?php

namespace Railroad\Maropost\Services;

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
        return $this->maropostGateway->post('lists', ['list' => $list->toArray()]);
    }

    /**
     * @param $id
     * @param ListVO $list
     * @return array
     */
    public function update($id, ListVO $list)
    {
        return $this->maropostGateway->put('lists/' . $id, ['list' => $list->toArray()]);
    }

    /**
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->maropostGateway->delete('lists/' . $id);
    }

    /**
     * @param $id
     * @return stdClass
     */
    public function show($id)
    {
        return $this->maropostGateway->get('lists/' . $id);
    }
}