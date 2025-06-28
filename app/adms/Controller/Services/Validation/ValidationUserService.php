<?php

namespace App\adms\Controller\Services\Validation;

class ValidationUserService
{
    public static function validate(array $data): array
    {
        //Criar Array que Deve Receber as Mensagens de Erro
        $errors = [];
        // var_dump($data);
        empty($data['name']) ? $errors['name'] = 'O Campo Nome Não Pode fica Vazio' : '';
        empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL) ? $errors['email'] = 'O Campo Email precisa ser Válido' : '';
        empty($data['password']) || strlen($data['password']) < 6    ? $errors['password'] = 'O Campo Senha deve Ter no Minimo 6 Caracteres' : '';

        return $errors;
    }
}
