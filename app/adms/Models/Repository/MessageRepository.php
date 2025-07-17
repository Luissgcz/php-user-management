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
        $query = "SELECT sub.*
FROM (
    SELECT m.*,
           u1.name AS sender_name,
           u1.image AS sender_image,
           u2.name AS receiver_name,
           u2.image AS receiver_image,
           LEAST(m.sender_id, m.receiver_id) AS user1,
           GREATEST(m.sender_id, m.receiver_id) AS user2,
           ROW_NUMBER() OVER (
             PARTITION BY LEAST(m.sender_id, m.receiver_id), GREATEST(m.sender_id, m.receiver_id)
             ORDER BY m.created_at DESC, m.id DESC
           ) AS rn
    FROM messages m
    JOIN ads u1 ON u1.id = m.sender_id
    JOIN ads u2 ON u2.id = m.receiver_id
    WHERE m.sender_id = :user_id OR m.receiver_id = :user_id
) sub
WHERE sub.rn = 1
ORDER BY sub.created_at DESC;";

        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":user_id", $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getConversation(int $userLoggedId, int $userTargetId): array
    {
        $query = "SELECT 
                m.*, 
                u.name AS sender_name, 
                u.image AS sender_image
              FROM messages m
              JOIN ads u ON u.id = m.sender_id
              WHERE (m.sender_id = :user_logged AND m.receiver_id = :user_target)
                 OR (m.sender_id = :user_target AND m.receiver_id = :user_logged)
              ORDER BY m.created_at ASC";

        $stmt = $this->getConnection()->prepare($query);
        $stmt->bindValue(":user_logged", $userLoggedId, PDO::PARAM_INT);
        $stmt->bindValue(":user_target", $userTargetId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
