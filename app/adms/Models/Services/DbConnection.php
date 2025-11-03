<?php

namespace App\adms\Models\Services;

use App\adms\Helpers\GenerateLog;
use Dotenv\Dotenv;
use Exception;
use PDO;

abstract class DbConnection
{
    private string $dbName;
    private string $user;
    private string $pass;
    private string $host;
    private int $port;
    private object|null $statusConnection = null;

    public function __construct()
    {
        $this->dbName = $_ENV['DB_NAME'] ?? '';
        $this->user   = $_ENV['DB_USER'] ?? '';
        $this->pass   = $_ENV['DB_PASS'] ?? '';
        $this->host   = $_ENV['DB_HOST'] ?? '';
        $this->port   = $_ENV['DB_PORT'] ?? 3306;
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
