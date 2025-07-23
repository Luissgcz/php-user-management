<?php

namespace App\adms\Models\Services;

use App\adms\Helpers\GenerateLog;
use Exception;
use PDO;

abstract class DbConnection
{
    private string $dbName = 'dblocal';
    private string $user = 'admin';
    private string $pass = 'admin';
    private string $host = 'localhost';
    private int $port = 3306;
    private object|null $statusConnection = null;

    public function __construct()
    {
        $this->dbName = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->pass = getenv('DB_PASS');
        $this->host = getenv('DB_HOST');
        $this->port = getenv('DB_PORT');
    }

    public function getConnection()
    {
        try {
            if ($this->statusConnection) {
                return $this->statusConnection;
            } else {
                $this->statusConnection = new PDO("mysql:host=$this->host;dbname=$this->dbName;port=$this->port", $this->user, $this->pass);
                return $this->statusConnection;
            }
        } catch (Exception $err) {
            GenerateLog::generateLog('alert', 'Erro ao Se Conectar com o Banco de Dados', ["error" => $err->getMessage()]);
            echo "Erro ao Se Conectar no Banco de Dados";
        }
    }
}
