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
            unset($_SESSION['csfr_tokens'][$formIdentifier]);

            return true;
        }
    }
}
