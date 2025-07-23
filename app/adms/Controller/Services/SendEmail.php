<?php

namespace App\adms\Controller\Services;

use App\adms\Helpers\GenerateLog;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class SendEmail
{
    public static function SendEmailRecoveryPassword($code, $email, $name)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host       = getenv('SERV_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = getenv('SERV_EMAIL');
            $mail->Password   = getenv('SERV_PASS');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = getenv('SERV_PORT');

            // Recipients
            $mail->setFrom(getenv('SERV_EMAIL'), getenv('SERV_NAME'));
            $mail->addAddress($email, $name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Solicitação de Recuperação de Senha';

            $link = getenv('APP_DOMAIN') . '/reset-password/' . $code;

            $mail->Body = '
            <html>
            <head>
                <style>
                    .btn {
                        display: inline-block;
                        padding: 12px 24px;
                        background-color: #007bff;
                        color: #fff;
                        text-decoration: none;
                        font-weight: bold;
                        border-radius: 6px;
                        margin-top: 20px;
                    }
                    .btn:hover {
                        background-color: #0056b3;
                    }
                    .container {
                        font-family: Arial, sans-serif;
                        background-color: #f9f9f9;
                        padding: 30px;
                        border: 1px solid #e1e1e1;
                        border-radius: 8px;
                        max-width: 600px;
                        margin: auto;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h2>Olá, ' . htmlspecialchars($name) . '</h2>
                    <p>Recebemos sua solicitação para redefinir sua senha.</p>
                    <p>Para continuar, clique no botão abaixo:</p>
                    <a href="' . $link . '" class="btn">Redefinir Senha</a>
                </div>
            </body>
            </html>
        ';

            $mail->AltBody = "Olá, $name\n\nRecebemos sua solicitação para redefinir sua senha.\nPara continuar, acesse o link abaixo:\n$link";

            $mail->send();
            $_SESSION['success'] = 'Mensagem Enviada com successo';
            header('Location:' . getenv('APP_DOMAIN') . '/login');
        } catch (Exception $err) {
            GenerateLog::generateLog('error', 'Não foi Possivel Enviar o Email de Recuperação', ["error" => $err->getMessage()]);
            $_SESSION['error'] = 'Erro ao Enviar Email de Recuperação';
            header('Location:' . getenv('APP_DOMAIN') . '/login');
        }
    }
}
