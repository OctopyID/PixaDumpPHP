<?php

namespace Octopy\PixaDump;

use Exception;
use Octopy\PixaDump\Http\Client;
use Octopy\PixaDump\Http\Request;

class PixaDump
{
    protected Client $client;

    /**
     * PixaDump constructor.
     */
    public function __construct()
    {
        $this->client = new Client;
    }

    /**
     * @param  array $args
     */
    public function send(...$args)
    {
        if (empty($args)) {
            return $this;
        }

        $payloads = Factory::getPayloads($args);

        try {
            $this->client->send(new Request(
                $payloads,
            ));
        } catch (Exception $exception) {
            //
        }
    }
}
