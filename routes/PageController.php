<?php

namespace Routes;

use App\adms\Helpers\ClearUrl;
use App\adms\Helpers\SlugController;

/**
 * Recebe a URL e Manipula a Mesma
 * 
 * @author Luis Cruz <luissgczdev@gmail.com>
 */

class PageController
{
    /** @var string $url Receber a URL do .htaccess */
    private string $url;

    /** @var array $urlArray Recebe uma URL e converte para um array */
    private array $urlArray;

    /** @var string  $urlController Recebe da URL o nome da controller*/
    private string $urlController = '';

    /** @var string $urlParameter Recebe da URL o Parametro */
    private string $urlParameter = '';

    /**
     * Recebe a URL do .htaccess
     */
    public function __construct()
    {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
            $this->url = ClearUrl::clearUrl($this->url);
            //Converter a String da URL em um Array

            $this->urlArray = explode("/", $this->url);


            //Verifica se Existe o Controller da URL
            if (isset($this->urlArray[0])) {
                $this->urlController = SlugController::slugController($this->urlArray[0]);
            } else {
                $this->urlController = 'Login';
            }

            if (isset($this->urlArray[1])) {
                $this->urlParameter = $this->urlArray[1];
            }
        } else {
            $this->urlController = 'Login';
        }
    }

    /**
     * Carregar a Pagina/controller
     * Instanciar a Classe para validar e Carregar Pagina/Controller
     * 
     * @return void
     */

    public function loadPage(): void
    {
        $loadPageAdm = new LoadPageAdm();
        $loadPageAdm->loadPageAdm($this->urlController, $this->urlParameter);
    }
}
