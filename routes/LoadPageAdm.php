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
    private array $listPgPrivate = ["Dashboard", "ListUsers", "ViewUser", "CreateUser", "EditUser", "DeleteUser", "EditPassword", "Logout", "FilterUsers", "FilterUsersForSendMsg", "MessageController"];
    /** @var array $listDirectory Recebe a Lista de Diretorios com a Controller */
    private array $listDirectory = ["login", "dashboard", "users", "errors", "messages"];
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
        $this->urlController = $urlController;


        $this->urlParameter = $urlParameter;


        // if (!$this->checkPageExists()) {

        //     //Chamar o Método para Salvar o Log
        //     GenerateLog::generateLog("error", "Pagina Não Encontrada", ['pagina' => $this->urlController, 'parametro' => $this->urlParameter]);
        //     $_SESSION['error'] = "Acesso não Autorizado";
        //     //Meus Arquivos Estaticos do Head estão passando pelo roteamento ai ta dando erro aqui, deixar comentando para resolver posteriormente
        //     header('Location:' . $_ENV['APP_DOMAIN'] . '/error403'); ##Aqui ta o Problema dessa Merda, antes tava login
        //     exit;
        // }


        if (!$this->checkControllerExists()) {
            GenerateLog::generateLog("error", 'Controller Não Encontrada', ['pagina' => $this->urlController, 'parametro' => $this->urlParameter]);
            //Pausa o Processamento
            die('Pagina Não Encontrada');
        }
    }

    /**
     * Verifica se a pagina existe no array de paginas publicas ou paginas privadas
     * 
     * @return bool
     */
    private function checkPageExists(): bool
    {
        if (in_array($this->urlController, $this->listPgPublic)) {
            return true;
        }

        if (in_array($this->urlController, $this->listPgPrivate) && isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }


    /** 
     * Verificar se existe a Controller
     * Chamar o método para verificar se existe o método dentro da controller, dei nome dos métodos padrão de "index"
     */

    private function checkControllerExists(): bool
    {
        foreach ($this->listPackages as $package) {

            foreach ($this->listDirectory as $directory) {
                $this->classLoad = "\\App\\$package\\Controller\\$directory\\" . $this->urlController;

                if (class_exists($this->classLoad)) {
                    $this->loadMethod();
                    return true;
                }
            }
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
        if (method_exists($classLoad, "index")) {
            $classLoad->{'index'}($this->urlParameter);
        } else {
            GenerateLog::generateLog("error", 'Método Não Encontrada', ['pagina' => $this->urlController, 'parametro' => $this->urlParameter, 'metodo' => $classLoad]);
            die('Método Não Encontrada');
        }
    }
}
