<?php

namespace App\adms\Helpers;

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;



class GenerateLog
{
    public static function generateLog(string $level, string $message, array|null $content): void
    {
        $log = new Logger('app');

        $logDir = __DIR__ . '/../../../../logs';

        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $nameFileLog = date('dmY') . ".log";
        $filePath = $logDir . '/' . $nameFileLog;


        $log->pushHandler(new StreamHandler($filePath, Level::Debug));

        $log->$level($message, $content ?? []);
    }
}
