<?php

namespace App\adms\Views\Services;

/**
 * 
 */

class LoadViewService
{
    private string $view;
    /**
     * @var string $view Recebe os dados que devem ser enviados para View
     * @param string $nameView Endereço da VIEW que deve ser carregada
     * @param array|string|null $data Dados que a View deve Receber
     */
    //Instanciando Aqui porque a versão do PHP é superior a 8.0   
    public function __construct(private string $nameView, private array|string|null $data) {}

    /**
     * Carregar a VIEW
     * Verificar se o arquivo existe, e carregar caso exista, não existindo para o carregamento
     * @return void
     */
    public function loadView(): void
    {
        $this->view = './app/' . $this->nameView . '.php';
        if (file_exists($this->view)) {
            include './app/adms/Views/layouts/main.php';
        } else {
            die('Erro 005: Por favor tente novamente');
        }
    }

    public function loadViewLogin(): void
    {
        $this->view = './app/' . $this->nameView . '.php';
        if (file_exists($this->view)) {
            include './app/adms/Views/layouts/login.php';
        } else {
            die('Erro 005: Por favor tente novamente');
        }
    }
}
