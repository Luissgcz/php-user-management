<?php

namespace App\adms\Helpers;

class SlugController
{

    public static function slugController(string $url): string
    {
        $url = strtolower($url);
        $url = str_replace("-", ' ', $url);
        $url = ucwords($url);
        $url = str_replace(" ", '', $url);
        return $url;
    }
}
