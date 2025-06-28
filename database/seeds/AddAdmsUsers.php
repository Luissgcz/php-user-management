<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class AddAdmsUsers extends AbstractSeed
{
    /**
     * Cadastrar Usuário no Banco de Dados
     */
    public function run(): void
    {
        // Variável para Receber os Dados
        $data = [];

        // Lista de 30 usuários
        $users = [
            ['name' => 'Luis Cruz', 'email' => 'luis@gmail.com'],
            ['name' => 'Kelly Cruz', 'email' => 'kelly@gmail.com'],
            ['name' => 'Celke Cruz', 'email' => 'celke@gmail.com'],
            ['name' => 'Ana Paula', 'email' => 'ana@gmail.com'],
            ['name' => 'Bruno Lima', 'email' => 'bruno@gmail.com'],
            ['name' => 'Carla Souza', 'email' => 'carla@gmail.com'],
            ['name' => 'Daniel Silva', 'email' => 'daniel@gmail.com'],
            ['name' => 'Elaine Costa', 'email' => 'elaine@gmail.com'],
            ['name' => 'Fernando Rocha', 'email' => 'fernando@gmail.com'],
            ['name' => 'Gabriela Nunes', 'email' => 'gabriela@gmail.com'],
            ['name' => 'Henrique Borges', 'email' => 'henrique@gmail.com'],
            ['name' => 'Isabela Martins', 'email' => 'isabela@gmail.com'],
            ['name' => 'João Pedro', 'email' => 'joao@gmail.com'],
            ['name' => 'Larissa Campos', 'email' => 'larissa@gmail.com'],
            ['name' => 'Marcelo Reis', 'email' => 'marcelo@gmail.com'],
            ['name' => 'Natália Gomes', 'email' => 'natalia@gmail.com'],
            ['name' => 'Otávio Dias', 'email' => 'otavio@gmail.com'],
            ['name' => 'Patrícia Moreira', 'email' => 'patricia@gmail.com'],
            ['name' => 'Rafael Cunha', 'email' => 'rafael@gmail.com'],
            ['name' => 'Sandra Melo', 'email' => 'sandra@gmail.com'],
            ['name' => 'Tiago Fernandes', 'email' => 'tiago@gmail.com'],
            ['name' => 'Ursula Barros', 'email' => 'ursula@gmail.com'],
            ['name' => 'Vanessa Teixeira', 'email' => 'vanessa@gmail.com'],
            ['name' => 'Wesley Castro', 'email' => 'wesley@gmail.com'],
            ['name' => 'Xavier Pinto', 'email' => 'xavier@gmail.com'],
            ['name' => 'Yasmin Lopes', 'email' => 'yasmin@gmail.com'],
            ['name' => 'Zilda Ferreira', 'email' => 'zilda@gmail.com'],
            ['name' => 'Adriana Rocha', 'email' => 'adriana@gmail.com'],
            ['name' => 'Breno Almeida', 'email' => 'breno@gmail.com'],
            ['name' => 'Camila Duarte', 'email' => 'camila@gmail.com'],
        ];

        // Verificar e montar os dados a serem inseridos
        foreach ($users as $user) {
            $existingRecord = $this->query(
                'SELECT * FROM ads WHERE email=:email',
                ['email' => $user['email']]
            )->fetch();

            if (!$existingRecord) {
                $data[] = [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'username' => $user['email'],
                    'password' => password_hash('123456a', PASSWORD_DEFAULT),
                    'created_at' => date("Y-m-d H:i:s")
                ];
            }
        }

        // Indicar em qual tabela salvar os registros
        $adms_users = $this->table('ads');

        // Inserir os registros na tabela
        if (!empty($data)) {
            $adms_users->insert($data)->save();
        }
    }
}
