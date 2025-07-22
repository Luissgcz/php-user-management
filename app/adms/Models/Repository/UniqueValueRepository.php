<?php

namespace App\adms\Models\Repository;

use App\adms\Models\Services\DbConnection;
use PDO;

class UniqueValueRepository extends DbConnection
{
    /**
     * Repository Responsavel pra verificar se existe um registro com os dados Fornecidos
     * @return bool
     */

    public function verifyUniqueData($table, $column, $value): bool
    {

        $stmt = $this->getConnection()->prepare("select count(*) as count from `{$table}` where `{$column}` = :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute([
            ':value' => $value
        ]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        // true for valid, false for invalid
        if (intval($data['count']) === 0) {
            return true;
        };
        return false;
    }
}
