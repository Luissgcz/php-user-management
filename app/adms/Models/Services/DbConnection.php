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
    private ?PDO $statusConnection = null;

    public function __construct()
    {
        if (!isset($_ENV['DB_HOST'])) {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
            $dotenv->load();
        }

        $this->dbName = $_ENV['DB_NAME'] ?? '';
        $this->user   = $_ENV['DB_USER'] ?? '';
        $this->pass   = $_ENV['DB_PASS'] ?? '';
        $this->host   = $_ENV['DB_HOST'] ?? '';
        $this->port   = (int) ($_ENV['DB_PORT'] ?? 3306);
    }

    public function getConnection(): PDO
    {
        try {
            if (!$this->statusConnection) {
                $dsn = "mysql:host={$this->host};dbname={$this->dbName};port={$this->port};charset=utf8";
                $this->statusConnection = new PDO($dsn, $this->user, $this->pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            }

            return $this->statusConnection;
        } catch (Exception $err) {

            var_dump([
                'DB_HOST' => $this->host,
                'DB_NAME' => $this->dbName,
                'DB_USER' => $this->user,
                'DB_PASS' => $this->pass,
                'DB_PORT' => $this->port,
                'error_message' => $err->getMessage()
            ]);
            exit;

            GenerateLog::generateLog(
                'alert',
                'Erro ao Se Conectar com o Banco de Dados',
                ["error" => $err->getMessage()]
            );

            echo "Erro ao Se Conectar no Banco de Dados";
            exit;
        }
    }
}
