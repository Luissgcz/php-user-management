<?php


//No diretorio App é o Alias do meu app, o qual eu designei dentro do composer.json e depois atualizei as dependencias do projeto para atualizar automaticamente no composer autoload_psr4
namespace App\admns\Controller\Services;

use App\admns\Helpers\ClearUrl;
use Login;

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
        echo "Caregar a Pagina <br>";
        //Verifica se tem valor na variavel URL
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) { //Tudo que ta vindo depois da minha pagina index.php, ele ta recebendo o parametro como url. Isso foi configurado dentro do htacces || se a url não estiver vazio vai nesse if, caso contrario cai na index
            $this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT); //Atribuindo para a variavel da classe URL
            echo "Tentando Acessar o Endereço <br>" .  $this->url;
            //Foi Criado um Helper para Limpar a URL
            //Chamar a Classe para Limpar a URL
            $this->url = ClearUrl::clearUrl($this->url); //Como o método e estatico, eu consigo chamar a classe a e o método assim ::
            //Converter a String da URL em um Array
            $this->urlArray = explode("/", $this->url); //Aqui ele vai separar a minha string, para cada barra que encontrar será um array novo
            var_dump($this->urlArray);

            //Verifica se Existe o Controller da URL
            if (isset($this->urlArray[0])) {
                $this->urlController = $this->urlArray[0];
                echo 'Caiu na Controller<br>';
            } else {
                $this->urlController = 'Login';
            }

            //Verifica se Existe o Parametro da URL
            if (isset($this->urlArray[1])) {
                $this->urlParameter = $this->urlArray[1];
                echo 'Caiu na Parameter';
            }
        } else {
            $this->urlController = new Login();
        }
        var_dump($this->urlController);
        var_dump($this->urlParameter);
    }
}
