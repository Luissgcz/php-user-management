<?php

namespace App\adms\Models\Repository;

use App\adms\Helpers\GenerateLog;
use App\adms\Models\Services\DbConnection;
use Exception;
use PDO;


class UsersRepository extends DbConnection
{
    /**
     * Recuperar os Usuário
     * @return array Usuários Recuperados do Banco de Dados
     */
    public function getAllUsers(int $page = 1, int $limitResults = 10)
    {
        $offSet = max(0, ($page - 1) * $limitResults);

        $sql = 'SELECT id,name,email,password,created_at,updated_at,image,status
        FROM ads
        ORDER BY name
        LIMIT :limit OFFSET :offset';

        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindValue(':limit', $limitResults, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offSet, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAmountUser(): int|bool
    {
        $sql = 'SELECT COUNT(id) as amount_records FROM ads';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['amount_records'] ?? 0;
    }

    public function getUser($id)
    {
        $sql = 'SELECT id,name,email,created_at,updated_at,image,phone,status
             FROM ads
             WHERE id=:id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUserInfo(int $id, string $name, string $email, int $updated_at, $phone, $status): bool
    {
        try {
            $sql = 'UPDATE ads SET name= :name, email= :email,updated_at= :updated_at,phone= :phone,status= :status WHERE id = :id';
            $str_updated_at = date("Y-m-d H:i:s", $updated_at);
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute([
                ':id' => $id,
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':status' => $status,
                ':updated_at' => $str_updated_at
            ]);
        } catch (Exception $err) {
            GenerateLog::generateLog('alert', 'Erro ao Editar Usuário', ["error" => $err->getMessage()]);
            return false;
        }
    }


    public function updateImg($id, $pathImg)
    {
        $sql = 'UPDATE ads SET image=:image WHERE id=:id';
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'image' => $pathImg
        ]);
    }


    public function getUserAdm($id)
    {
        $sql = 'SELECT *
             FROM ads
             WHERE id=:id';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertUser(string $name, string $email, $password,  int $created_at): bool
    {
        try {
            $sql = 'INSERT INTO ads (name,email,password,created_at) VALUES (:name,:email,:password,:created_at)';
            $stmt = $this->getConnection()->prepare($sql);
            $strToTime = date("Y-m-d H:i:s", $created_at);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $password,
                ':created_at' => $strToTime
            ]);
            return true;
        } catch (Exception $err) {
            GenerateLog::generateLog('alert', 'Erro ao Inserir Novo Usuário', ["error" => $err->getMessage()]);
            return false;
        }
    }

    public function updateUser(int $id, string $name, string $email, int $updated_at): bool
    {

        $sql = 'UPDATE ads SET name= :name, email= :email,updated_at= :updated_at WHERE id = :id';
        $str_updated_at = date("Y-m-d H:i:s", $updated_at);
        $stmt = $this->getConnection()->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':email' => $email,
            ':updated_at' => $str_updated_at
        ]);
    }


    public function deleteUser(int|string $id): bool
    {
        try {
            $sql = 'DELETE FROM ads WHERE id=:id';
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch (Exception $err) {
            GenerateLog::generateLog('alert', 'Erro ao Deletar Usuário', ["error" => $err->getMessage()]);
            return false;
        }
    }

    public function updatePassword(int|string $id, $newPassword, int $updated_at): bool
    {
        try {
            $str_updated_at = date("Y-m-d H:i:s", $updated_at);
            $sql = 'UPDATE ads SET password = :password,updated_at = :updated_at WHERE id=:id';
            $stmt = $this->getConnection()->prepare($sql);
            return $stmt->execute([
                ':password' => $newPassword,
                ':id' => $id,
                ':updated_at' => $str_updated_at
            ]);
        } catch (Exception $err) {
            GenerateLog::generateLog('alert', 'Erro ao Atulizar a Senha', ["error" => $err->getMessage()]);
            return false;
        }
    }

    public function authUser($email, $password)
    {
        try {
            $sql = 'SELECT * FROM ads WHERE email = :email LIMIT 1';
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':email' => $email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['name'];
                $_SESSION['userId'] = $user['id'];
                return true;
            } else {
                return false;
            }
        } catch (Exception $err) {
            GenerateLog::generateLog('alert', 'Erro ao Logar no Sistema', ["error" => $err->getMessage()]);
            return false;
        }
    }

    public function newUser($name, $email, $password, $created_at): bool
    {
        try {
            $sql = 'INSERT INTO ads (name,email,password,created_at) VALUES (:name,:email,:password,:created_at)';
            $stmt = $this->getConnection()->prepare($sql);
            $strToTime = date("Y-m-d H:i:s", $created_at);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $password,
                ':created_at' => $strToTime
            ]);
            return true;
        } catch (Exception $err) {
            GenerateLog::generateLog('alert', 'Erro ao Cadastrar novo Usuário', ["error" => $err->getMessage()]);
            return false;
        }
    }
}
