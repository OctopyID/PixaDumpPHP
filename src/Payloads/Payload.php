<?php

namespace Octopy\PixaDump\Payloads;

abstract class Payload
{
    abstract protected function getType() : string;

    abstract protected function getData();

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'type' => $this->getType(),
            'data' => $this->getData(),
        ];
    }
}
