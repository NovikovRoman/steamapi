<?php

namespace SteamAPI;

interface CategoryInterface
{
    public function __construct($apiKey);

    public static function categoryName(): string;
}