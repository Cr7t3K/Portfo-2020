<?php

namespace App\Service\API;


class GithubManager extends AbstractManager
{
    protected $client;

    protected $url = "http://api.betaseries.com/";

    protected $method = "shows/list?key=";

    protected $key = "APP_GITHUB_KEY";

    public function __construct()
    {
        parent::__construct($this->url, $this->key, $this->method);
    }

    public function sortUpcoming(int $number) :Array
    {
        $response = $this->client->request(
            'GET', $this->url . $this->method . $this->key . "&v=3.0&order=popularity&recent=true&limit=" . $number
        );
        $datas = $response->toArray();

        return $datas['shows'];
    }
}
