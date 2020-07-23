<?php

namespace App\Service\API;

use Symfony\Component\HttpClient\HttpClient;

class AbstractManager
{
    protected $client;

    protected $url;

    protected $method;

    protected $pass;

    protected $id;

    public function __construct(string $url, string $pass, string $method, string $id)
    {
        $this->client = HttpClient::create();
        $this->url = $url;
        $this->method = $method;
        $this->pass = $_SERVER[$pass];
        $this->id = $_SERVER[$id];
    }

}
