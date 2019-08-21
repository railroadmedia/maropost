<?php

namespace Railroad\Maropost\ValueObjects;

class TagVO
{
    public $name;

    /**
     * TagVO constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
          'name' =>  $this->name,
        ];
    }
}