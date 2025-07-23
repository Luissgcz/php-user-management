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
        $sql = 'SELECT id,name,email,password,created_at,updated_at
                 FROM ads
                 WHERE email=:email';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([
            ':email' => $email
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertDataRecovery($email, $keyRecovery, $validateRecoveryPassword): bool
    {
        try {
            $sql = 'UPDATE ads SET recovery_password= :recovery_password, validate_recovery_password= :validate_recovery_password WHERE email=:email';
            $stmt = $this->getConnection()->prepare($sql);
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
        $sql = 'SELECT *
                 FROM ads
                 WHERE recovery_password=:recovery_password';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([
            ':recovery_password' => $key
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function alterPassword($recoveryPassword, $password)
    {
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
    }
}
