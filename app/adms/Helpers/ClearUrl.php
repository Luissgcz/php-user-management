<?php


namespace App\adms\Helpers;

class ClearUrl
{
    /**
     * Limpar URL
     * @author Luis Cruz <luissgczdev@gmail.com>
     * 
     * Método Estático pode ser chamado diretamente na classe, sem a necessidade de criar uma instancia(OBJETO) da classe. 
     * Limpara a URL, eliminando as TAG, os Espaços em Branco, retirar a barra no final da URL e Retirar os caracteres especiais
     */

    public static function clearUrl(string $url): string
    {
        $url = rtrim($url, '/');

        $url = preg_replace('/[^a-zA-Z0-9\-._~:\/?#\[\]@!$&\'()*+,;=%]/', '', $url);
        return $url;
    }
}
