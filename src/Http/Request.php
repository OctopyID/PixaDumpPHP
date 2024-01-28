<?php

namespace Octopy\PixaDump\Http;

use Octopy\PixaDump\Payloads\Payload;
use Ramsey\Uuid\Uuid;

final class Request
{
    /**
     * @param  array $payloads
     */
    public function __construct(protected array $payloads = [])
    {
        //
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'uuid' => Uuid::uuid4(),
            'time' => time(),
            'data' => array_map(fn(Payload $payload) => $payload->toArray(), $this->payloads),
            'meta' => [
                'type' => 'in', // in|em|am|re|sl
            ],
        ];
    }

    /**
     * @return bool|string
     */
    public function toJSON() : bool|string
    {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
}
