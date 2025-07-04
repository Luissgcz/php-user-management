<?php

namespace App\adms\Helpers;

class CSFRHelper
{
    /**
     * Gerar um Token Unico
     * @param string $formIdentifier    Identificados do Formulário
     * @param string TOKEN CSFR gerado
     */

    public static function generateCSFRToken(string $formIdentifier): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        //A função random_bytes gera uma sequencia de 32 bytes aleatorios.
        //A função bin2hex converte os bytes binarios gerados pela função random_bytes em um representação hexadecimal
        $token = bin2hex(random_bytes(32));
        $_SESSION['csfr_tokens'][$formIdentifier] =  $token;
        return $token;
    }

    /**
     * Validar o CSFR Token
     * @param string $formIdentifier    Identificados do Formulário
     * @param string TOKEN CSFR gerado
     * @return bool  True se o Token For Valido, FALSE caso contrario
     */
    public static function validateCSFRToken(string $formIdentifier, string $token)
    {
        if (isset($_SESSION['csfr_tokens'][$formIdentifier]) && hash_equals($_SESSION['csfr_tokens'][$formIdentifier], $token)) {
            //Token Usado Deve Ser Invalidado
            unset($_SESSION['csfr_tokens'][$formIdentifier]);

            return true;
        }
    }
}
