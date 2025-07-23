<?php

namespace App\adms\Helpers;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class GenerateLog
{

    public static function generateLog(string $level,  string $message, array|null $content): void
    {
        $log = new Logger('name');

        $nameFileLog = date('dmY') . ".log";

        $filePath = 'logs/' . $nameFileLog;

        if (!file_exists($filePath)) {
            $fileOpen = fopen($filePath, 'w');

            fclose($fileOpen);
        }

        $log->pushHandler(new StreamHandler($filePath, Level::Debug));

        $log->$level($message, $content);
    }
}
