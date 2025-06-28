<?php

namespace App\adms\Controller\Services\Validation;

class ValidationEmptyField
{
    public static function validateEmptyField(array $data)
    {
        $errors = [];
        $data = array_map('trim', $data);

        foreach ($data as $key => $value) {
            if ($value === '') {
                $errors[$key] = "O campo {$key} não pode ficar vazio";
            }
        }

        return $errors; // retorna array vazio se não houver erros
    }
}
