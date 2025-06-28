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
        $url = rtrim($url, '/'); //rtrim remove tudo do final da string que eu especificar. ex: rtrim($ex, 'r') $ex= 'folderrr' output seria: 'folde'

        $url = preg_replace('/[^a-zA-Z0-9\-._~:\/?#\[\]@!$&\'()*+,;=%]/', '', $url);
        //Expressão regular para caracteres invalidos, todos vão ser trocados por "" vazio do parametro $url, daria para ter utilizado o str_replace mas como usei regex, não teria como, só se criasse um array de caracteres que eu não queria, ai daria para utilizar
        return $url;  //Retorna a URL formatada
    }
}
