<?php

namespace App\Service\API;

use Symfony\Component\HttpClient\HttpClient;

class AbstractManager
{
    protected $client;

    protected $url;

    protected $method;

    protected $key;

    public function __construct(string $url, string $key, string $method)
    {
        $this->client = HttpClient::create();
        $this->url = $url;
        $this->method = $method;
        $this->key = $_SERVER[$key];
    }

}
