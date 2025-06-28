<?php

namespace App\adms\Helpers;

class GenerateKeyRecovery
{
    public static function GenerateKeyRecoveryPassword()
    {
        $codeHash = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 7);
        return $codeHash;
    }
}
