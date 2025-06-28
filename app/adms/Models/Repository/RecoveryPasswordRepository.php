<?php

namespace App\adms\Models\Repository;

use App\adms\Helpers\GenerateLog;
use App\adms\Models\Services\DbConnection;
use Exception;
use PDO;

class RecoveryPasswordRepository extends DbConnection
{
    public function validateEmailExists($email)
    {
        //Query para Pegar os Registro do DB de um Usuário Especifico
        $sql = 'SELECT id,name,email,username,password,created_at,updated_at
                 FROM ads
                 WHERE email=:email';
        //Preparar a Query
        $stmt = $this->getConnection()->prepare($sql);
        //Executar a Query
        $stmt->execute([
            ':email' => $email
        ]);
        //Retornar todos os resultados
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertDataRecovery($email, $keyRecovery, $validateRecoveryPassword): bool
    {
        try {
            $sql = 'UPDATE ads SET recovery_password= :recovery_password, validate_recovery_password= :validate_recovery_password WHERE email=:email';
            $stmt = $this->getConnection()->prepare($sql);
            // $strToTime = date("Y-m-d H:i:s", $created_at);
            return $stmt->execute([
                ':email' => $email,
                ':recovery_password' => $keyRecovery,
                ':validate_recovery_password' => $validateRecoveryPassword,
            ]);
        } catch (Exception $err) {
            GenerateLog::generateLog('alert', 'Erro ao Inserir Novo Usuário', ["error" => $err->getMessage()]);
            return false;
        }
    }

    public function validateResetPass($key)
    {
        //Query para Pegar os Registro do DB de um Usuário Especifico
        $sql = 'SELECT *
                 FROM ads
                 WHERE recovery_password=:recovery_password';
        //Preparar a Query
        $stmt = $this->getConnection()->prepare($sql);
        //Executar a Query
        $stmt->execute([
            // ':email' => $email,
            ':recovery_password' => $key
        ]);
        //Retornar todos os resultados
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function alterPassword($recoveryPassword, $password)
    {
        //Query para Pegar os Registro do DB de um Usuário Especifico
        $sql = 'UPDATE ads
                 SET password = :newPassword, updated_at = :updated_at
                 WHERE recovery_password=:recovery_password';
        //Preparar a Query
        $stmt = $this->getConnection()->prepare($sql);
        //Executar a Query
        return $stmt->execute([
            ':recovery_password' => $recoveryPassword,
            ':newPassword' => $password,
            ':updated_at' => date("Y-m-d H:i:s")
        ]);
        //Retornar todos os resultados

    }
}
