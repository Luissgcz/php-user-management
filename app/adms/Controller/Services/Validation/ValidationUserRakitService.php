<?php

namespace App\adms\Controller\Services\Validation;

use App\adms\Controller\Services\Validation\UniqueRule;
use Rakit\Validation\Validator;

class ValidationUserRakitService
{
    public static function validateCreateUser(array $data)
    {
        $errors = [];
        $validator = new Validator;

        //Validador de Unique no Banco, passando o unique
        $validator->addValidator('unique', new UniqueRule());


        $validation = $validator->make($data, [
            'name' => 'required|min:3',
            //Instanciando o unique, passando minha tabela e a coluna a qual quero validar
            'email' => 'required|email|unique:ads,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);

        $validation->setMessages([
            'name:min' => 'O Campo Nome Deve Ter No Minimo 3 Caracteres',
            'name:required' => 'O Campo Nome é Obrigatório',
            'email:required' => 'O Campo Email é Obrigatório',
            'email:unique' => 'Email já Cadastrado',
            'email:email' => 'O Campo Email é Inválido',
            'password:required' => 'O Campo Senha é Obrigatório',
            'password:min' => 'O Campo Senha Deve Ter No Minimo 6 Caracteres',
            'confirmPassword:same' => 'As senhas não coincidem '
        ]);

        //Validar os Dados
        $validation->validate();
        if ($validation->fails()) {
            // var_dump($validation->errors());
            $arrayErrors = $validation->errors();
            //First of All pega todos os valores do Array
            foreach ($arrayErrors->firstOfAll() as $key => $value) {
                //For Each em todos os valores do array, para cada chave eu atribuo o nome da chave para o array errors, passando a mensagem 
                $errors[$key] = $value;
            }
        }
        return $errors;
    }

    public static function validateLogin(array $data)
    {
        $errors = [];
        $validator = new Validator;

        $validator->addValidator('unique', new UniqueRule());


        $validation = $validator->make($data, [
            //Instanciando o unique, passando minha tabela e a coluna a qual quero validar
            'email' => 'required|email',
            'password' => 'required',

        ]);

        $validation->setMessages([
            'email:required' => 'Formato de Email Inválido',
            'email:email' => 'Email é Inválido',
            'password:required' => 'Formato de Senha Inválido',
        ]);

        //Validar os Dados
        $validation->validate();
        if ($validation->fails()) {
            $arrayErrors = $validation->errors();
            //First of All pega todos os valores do Array
            foreach ($arrayErrors->firstOfAll() as $key => $value) {
                //For Each em todos os valores do array, para cada chave eu atribuo o nome da chave para o array errors, passando a mensagem 
                $errors[$key] = $value;
            }
        }
        return $errors;
    }


    public static function validateNewLogin(array $data)
    {
        $errors = [];
        $validator = new Validator;

        //Validador de Unique no Banco, passando o unique
        $validator->addValidator('unique', new UniqueRule());


        $validation = $validator->make($data, [
            //Instanciando o unique, passando minha tabela e a coluna a qual quero validar
            'name' => 'required',
            'email' => 'required|email|unique:ads,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',

        ]);

        $validation->setMessages([
            'name:required' => 'O Campo Nome é Obrigatório',
            'email:required' => 'O Campo Email é Obrigatório',
            'email:unique' => 'Email já Cadastrado',
            'email:email' => 'O Campo Email é Inválido',
            'password:required' => 'O Campo Senha é Obrigatório',
            'password:min' => 'O Campo Senha Deve Ter No Minimo 6 Caracteres',
            'confirmPassword:same' => 'As senhas não coincidem '

        ]);

        //Validar os Dados
        $validation->validate();
        if ($validation->fails()) {
            $arrayErrors = $validation->errors();
            //First of All pega todos os valores do Array
            foreach ($arrayErrors->firstOfAll() as $key => $value) {
                //For Each em todos os valores do array, para cada chave eu atribuo o nome da chave para o array errors, passando a mensagem 
                $errors[$key] = $value;
            }
        }
        return $errors;
    }

    public static function validateRecoveryEmail(array $data)
    {
        $errors = [];
        $validator = new Validator;

        //Validador de Unique no Banco, passando o unique
        $validator->addValidator('unique', new UniqueRule());


        $validation = $validator->make($data, [
            //Instanciando o unique, passando minha tabela e a coluna a qual quero validar
            'email' => 'required|email',

        ]);

        $validation->setMessages([
            'email:required' => 'O Campo Email é Obrigatório',
            'email:email' => 'O Campo Email é Inválido',
        ]);

        //Validar os Dados
        $validation->validate();
        if ($validation->fails()) {
            $arrayErrors = $validation->errors();
            //First of All pega todos os valores do Array
            foreach ($arrayErrors->firstOfAll() as $key => $value) {
                //For Each em todos os valores do array, para cada chave eu atribuo o nome da chave para o array errors, passando a mensagem 
                $errors[$key] = $value;
            }
        }
        return $errors;
    }

    public static function validateRecoveryPassword(array $data)
    {
        $errors = [];
        $validator = new Validator;

        //Validador de Unique no Banco, passando o unique
        $validator->addValidator('unique', new UniqueRule());


        $validation = $validator->make($data, [
            //Instanciando o unique, passando minha tabela e a coluna a qual quero validar
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',

        ]);

        $validation->setMessages([
            'password:required' => 'O Campo Senha é Obrigatório',
            'password:min' => 'O Campo Senha Deve Ter No Minimo 6 Caracteres',
            'confirmPassword:same' => 'As senhas não coincidem '
        ]);

        //Validar os Dados
        $validation->validate();
        if ($validation->fails()) {
            $arrayErrors = $validation->errors();
            //First of All pega todos os valores do Array
            foreach ($arrayErrors->firstOfAll() as $key => $value) {
                //For Each em todos os valores do array, para cada chave eu atribuo o nome da chave para o array errors, passando a mensagem 
                $errors[$key] = $value;
            }
        }
        return $errors;
    }

    public static function validateUpdatePassword(array $data)
    {
        $errors = [];
        $validator = new Validator;

        //Validador de Unique no Banco, passando o unique
        $validator->addValidator('unique', new UniqueRule());


        $validation = $validator->make($data, [
            //Instanciando o unique, passando minha tabela e a coluna a qual quero validar
            'newPassword' => 'required|min:6',

        ]);

        $validation->setMessages([
            'newPassword:required' => 'O Campo Senha é Obrigatório',
            'newPassword:min' => 'O Campo Senha Deve Ter No Minimo 6 Caracteres',
        ]);

        //Validar os Dados
        $validation->validate();
        if ($validation->fails()) {
            $arrayErrors = $validation->errors();
            //First of All pega todos os valores do Array
            foreach ($arrayErrors->firstOfAll() as $key => $value) {
                //For Each em todos os valores do array, para cada chave eu atribuo o nome da chave para o array errors, passando a mensagem 
                $errors[$key] = $value;
            }
        }
        return $errors;
    }
    public static function validateEditUser(array $data)
    {
        $errors = [];
        $validator = new Validator;

        $validation = $validator->make($data, [
            //Instanciando o unique, passando minha tabela e a coluna a qual quero validar
            'name' => 'min:3|required',
            'email' => 'required|email',

        ]);

        $validation->setMessages([
            'name:required' => 'O Campo Nome é Obrigatório',
            'name:min' => 'O Campo Nome deve ter no Minimo 3 Caracteres',
            'email:required' => 'O Campo Email é Obrigatório',
            'email:email' => 'Formato de Email Invalido',
        ]);

        //Validar os Dados
        $validation->validate();
        if ($validation->fails()) {
            $arrayErrors = $validation->errors();
            //First of All pega todos os valores do Array
            foreach ($arrayErrors->firstOfAll() as $key => $value) {
                //For Each em todos os valores do array, para cada chave eu atribuo o nome da chave para o array errors, passando a mensagem 
                $errors[$key] = $value;
            }
        }
        return $errors;
    }
}
