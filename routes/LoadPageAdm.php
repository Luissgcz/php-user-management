<?php

namespace Routes;

use App\adms\Helpers\GenerateLog;

class LoadPageAdm
{

    /** @var string $urlController Recebe da URL o nome da Controller */
    private string $urlController;
    /** @var string $urlParameter Recebe da URL o Parametro */
    private string $urlParameter;
    /** @var array $listPhPublic Recebe a lista de paginas publicas */
    private array $listPgPublic = ["Login", "Error403", "NewLogin", "RecoveryPassword", "ResetPassword"];
    /** @var array $listPgPrivate Recebe a lista de paginas privadas */
    private array $listPgPrivate = ["Dashboard", "ListUsers", "ViewUser", "CreateUser", "EditUser", "DeleteUser", "EditPassword", "Logout"];
    /** @var array $listDirectory Recebe a Lista de Diretorios com a Controller */
    private array $listDirectory = ["login", "dashboard", "users", "errors"];
    /** @var array $listPackages Verifica o pacote que contém a Controller */
    private array $listPackages = ["adms"];
    /** @var string $classLoad Responsavel pela controller que deve ser carregada */
    private string $classLoad;



    /** 
     * Verifica se existe a pagina com o método checkPageExists
     * Verifica se existe a classe com o método checkControllerExists
     * @param string $urlController Recebe a URL o nome da controller
     * @param string $urlParameter Recebe da URL o parametro
     * 
     * @return void
     */


    public function loadPageAdm(string|null $urlController, string|null $urlParameter): void
    {
        //Eu atribuo o valor da variavel para esse atribudo porque ai consigo utilizar em outros lugares da classe, caso contrario só ia conseguir instanciar nessa função
        $this->urlController = $urlController;
        // var_dump($this->urlController);
        $this->urlParameter = $urlParameter;
        if (!$this->checkPageExists()) {
            //Chamar o Método para Salvar o Log
            GenerateLog::generateLog("error", "Pagina Não Encontrada", ['pagina' => $this->urlController, 'parametro' => $this->urlParameter]);

            die('Pagina não Existe');
        }


        if (!$this->checkControllerExists()) {
            GenerateLog::generateLog("error", 'Controller Não Encontrada', ['pagina' => $this->urlController, 'parametro' => $this->urlParameter]);
            //Pausa o Processamento
            die('Controller Não Encontrada');
        }
    }

    /**
     * Verifica se a pagina existe no array de paginas publicas ou paginas privadas
     * 
     * @return bool
     */
    private function checkPageExists(): bool
    {
        // Verifica se Existe a Pagina Existe no Array Public
        if (in_array($this->urlController, $this->listPgPublic)) {
            return true;
        }

        // Verifica se Existe a Pagina no Array Private
        if (in_array($this->urlController, $this->listPgPrivate) && isset($_SESSION['user'])) {
            return true;
        } else {
            $_SESSION['error'] = "Acesso não Autorizado";
            header('Location:' . $_ENV['APP_DOMAIN'] . '/login');
        }

        return false;
    }


    /** 
     * Verificar se existe a Controller
     * Chamar o método para verificar se existe o método dentro da controller, dei nome dos métodos padrão de "index"
     */

    private function checkControllerExists(): bool
    {
        //Percorrer o Array de Pacotes
        foreach ($this->listPackages as $package) {

            //Percorrer o Array De Diretorios depois de acessar o Pacote adms
            foreach ($this->listDirectory as $directory) {
                $this->classLoad = "\\App\\$package\\Controller\\$directory\\" . $this->urlController;


                //Verificar se a Classe Existe
                if (class_exists($this->classLoad)) {
                    // var_dump($package, $directory);
                    $this->loadMethod();
                    // var_dump($this->classLoad);
                    return true;
                }
            }

            // return true;
        }
        return false;
    }

    /**
     * Verificar se existe o método e carrega a pagina/controller
     * @return void
     */
    private function loadMethod(): void
    {
        //Instanciar a Classe
        $classLoad = new $this->classLoad();
        // var_dump($classLoad);
        if (method_exists($classLoad, "index")) {
            //Carrega o Método
            $classLoad->{'index'}($this->urlParameter);
        } else {
            GenerateLog::generateLog("error", 'Método Não Encontrada', ['pagina' => $this->urlController, 'parametro' => $this->urlParameter, 'metodo' => $classLoad]);
            //Pausa o Processamento
            die('Método Não Encontrada');
        }
    }
}
