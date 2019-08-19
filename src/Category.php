<?php

namespace SteamAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class Category
{
    const baseUrl = 'https://api.steampowered.com';
    protected $apiKey;
    /** @var Client */
    protected $httpClient;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new Client();
    }

    protected function buildUrl($category, $url)
    {
        $url = self::baseUrl . $category . $url;
        return str_replace('{key}', $this->apiKey, $url);
    }

    /**
     * @param $url
     * @return array
     * @throws GuzzleException
     */
    protected function get($url)
    {
        $response = $this->httpClient->request('GET', $url);
        $data = json_decode($response->getBody()->getContents(), true);
        return empty($data['response']) ? [] : $data['response'];
    }
}