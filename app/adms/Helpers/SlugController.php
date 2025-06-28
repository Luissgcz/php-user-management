<?php

namespace App\adms\Helpers;

class SlugController
{

    public static function slugController(string $url): string
    {
        $url = strtolower($url); //Convertendo tudo para minusculo
        $url = str_replace("-", ' ', $url); //Replace dos hifens por espaço em branco para separar a String
        $url = ucwords($url); //Cada Palavra da String vai ter Letra Maiuscula
        $url = str_replace(" ", '', $url);
        return $url;
    }
}
