<?php

namespace App\Service\API;


class GithubManager extends AbstractManager
{
    protected $client;

    protected $url = "https://api.github.com/";

    protected $method = "repos/Cr7t3K/";

    protected $pass = "APP_GITHUB_PASS";

    protected $id = "APP_GITHUB_ID";

    public function __construct()
    {
        parent::__construct($this->url, $this->pass, $this->method, $this->id);
    }

    public function getStats(string $repo, ?string $info = null) :Array
    {
        if (isset($info)) {
            $response = $this->client->request(
                'GET', $this->url . $this->method . $repo . '/' . $info);
        } else {
            $response = $this->client->request(
                'GET', $this->url . $this->method . $repo);
        }

        return $response->toArray();
    }
}
