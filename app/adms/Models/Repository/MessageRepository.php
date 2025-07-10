<?php

namespace App\adms\Models\Repository;

use App\adms\Models\Services\DbConnection;
use PDO;

class MessageRepository extends DbConnection
{
    public function sendMessage(array $data): bool
    {
        $query = "INSERT INTO messages (sender_id, receiver_id, message) 
              VALUES (:sender_id, :receiver_id, :message)";
        $stmt = $this->getConnection()->prepare($query);
        return $stmt->execute([
            ':sender_id' => $data['sender_id'],
            ':receiver_id' => $data['receiver_id'],
            ':message' => $data['message']
        ]);
    }

    public function getInbox(int $userId): array
    {
        $query = "SELECT m.*, u.name as sender_name 
              FROM messages m
              JOIN ads u ON u.id = m.sender_id
              WHERE receiver_id = :user_id
              ORDER BY created_at DESC";

        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
