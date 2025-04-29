<?php


//No diretorio App é o Alias do meu app, o qual eu designei dentro do composer.json e depois atualizei as dependencias do projeto para atualizar automaticamente no composer autoload_psr4
namespace App\admns\Controller\Services;

/**
 * Recebe a URL e Manipula a Mesma
 * 
 * @author Luis Cruz <luissgczdev@gmail.com>
 */

class PageController
{
    public function __construct()
    {
        echo ("Caregar a Pagina");
    }
}
