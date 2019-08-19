<?php

namespace SteamAPI;

use GuzzleHttp\Exception\GuzzleException;

class IPlayerService extends Category implements CategoryInterface
{
    const category = '/IPlayerService';

    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
    }

    public static function categoryName(): string
    {
        return self::category;
    }

    /**
     * @param $id
     * @return int
     * @throws GuzzleException
     */
    public function getSteamLevel($id)
    {
        $url = $this->buildUrl(self::categoryName(), '/GetSteamLevel/v1/?key={key}&steamids=' . $id);
        $data = $this->get($url);
        return empty($data['player_level']) ? 0 : (int)$data['player_level'];
    }

    /**
     * @param $id
     * @return array
     * @throws GuzzleException
     */
    public function getOwnedGames($id)
    {
        $url = $this->buildUrl(
            self::categoryName(),
            '/GetOwnedGames/v00001/?include_appinfo=true&key={key}&steamids=' . $id
        );
        return $this->get($url);
    }
}