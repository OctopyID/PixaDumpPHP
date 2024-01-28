<?php

namespace Octopy\PixaDump\Http;

use CurlHandle;
use Exception;

class Client
{
    /**
     * @var CurlHandle|false
     */
    private CurlHandle|false $handler = false;

    /**
     * @param  string $host
     * @param  int    $port
     */
    public function __construct(protected string $host = 'localhost', protected int $port = 1337)
    {
        //
    }

    /**
     * @throws Exception
     */
    public function send(Request $param) : void
    {
        $this->post('/dump', $param);
    }

    /**
     * @throws Exception
     */
    public function post(string $url, Request $request)
    {
        $handler = $this->getCurlHandle($url);

        curl_setopt_array($handler, [
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => $request->toJSON(),
        ]);

        $response = curl_exec($handler);

        if (curl_errno($handler)) {
            throw new Exception(curl_error($handler));
        }

        curl_close($handler);

        return json_decode($response);
    }

    /**
     * @param  string $url
     * @return CurlHandle|bool
     */
    private function getCurlHandle(string $url) : CurlHandle|bool
    {
        if (! $this->handler) {
            $this->handler = curl_init();
        }

        curl_setopt_array($this->handler, [
            CURLOPT_URL            => 'http://' . $this->host . ':' . $this->port . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
            ],
        ]);

        return $this->handler;
    }
}
