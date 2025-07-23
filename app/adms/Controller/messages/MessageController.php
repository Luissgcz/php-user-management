<?php

namespace App\adms\Controller\messages;

use App\adms\Models\Repository\MessageRepository;
use App\adms\Views\Services\LoadViewService;

class MessageController
{
    private string|array|null  $data = null;

    // Função para listar mensagens recebidas (GET)
    public function index(): void
    {
        $messageModel = new MessageRepository();
        $userId = $_SESSION['userId'];


        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($data) {
            $this->sendMessage($data);
        }

        $withUserId = filter_input(INPUT_GET, 'with', FILTER_VALIDATE_INT);

        if ($withUserId) {
            $this->data['conversation'] = $messageModel->getConversation($userId, $withUserId);
            $this->data['with_user_id'] = $withUserId;
            $this->data['messages'] = $messageModel->getInbox($userId);
            $loadView = new LoadViewService('adms/Views/dashboard/dashboard', $this->data);
            $loadView->loadView();
        } else {
            $this->data['messages'] = $messageModel->getInbox($userId);
            $loadView = new LoadViewService('adms/Views/dashboard/dashboard', $this->data);
            $loadView->loadView();
        }
    }

    public function sendMessage($data): void
    {
        if (!empty($data['receiver_id']) && !empty($data['message'])) {

            $messageModel = new MessageRepository();
            $messageModel->sendMessage([
                'sender_id' => $_SESSION['userId'],
                'receiver_id' => $data['receiver_id'],
                'message' => $data['message'],
            ]);
            $_SESSION['success'] = "Mensagem enviada com sucesso.";
        } else {
            $_SESSION['error'] = "Todos os campos são obrigatórios.";
        }

        header("Location:" . $_ENV['APP_DOMAIN'] . '/message-controller/?with=' . $data['receiver_id']);
        exit;
    }
}
