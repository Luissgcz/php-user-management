<?php

namespace App\adms\Helpers;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class GenerateLog
{

    public static function generateLog(string $level,  string $message, array|null $content): void
    {
        //Criar o Logger
        $log = new Logger('name');

        //Obter a Data Atual dos Logs no formato ddmmyyyy
        $nameFileLog = date('dmY') . ".log";

        //Criar o Caminho dos Logs
        $filePath = 'logs/' . $nameFileLog;

        //Verificar se o Arquivo Existe
        if (!file_exists($filePath)) {
            //Abrir o Arquivo para Escrita
            $fileOpen = fopen($filePath, 'w');

            //Fechar o Arquivo
            fclose($fileOpen);
        }


        //Utilizar o StreamHandler para salvar o log no arquivo
        $log->pushHandler(new StreamHandler($filePath, Level::Debug));

        //Salvar o Log no Arquivo
        $log->$level($message, $content);
    }
}
