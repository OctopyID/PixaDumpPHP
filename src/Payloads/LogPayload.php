<?php

namespace Octopy\PixaDump\Payloads;

class LogPayload extends Payload
{
    /**
     * @param  string $data
     */
    public function __construct(protected string $data)
    {
        //
    }

    /**
     * @return string
     */
    protected function getType() : string
    {
        return 'log';
    }

    /**
     * @return array
     */
    protected function getData() : array
    {
        return [
            'label' => 'LOG',
            'value' => $this->data
        ];
    }
}
