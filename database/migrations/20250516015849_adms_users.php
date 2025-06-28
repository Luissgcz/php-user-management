<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AdmsUsers extends AbstractMigration
{
    /**
     * Criar a Tabela admsUsers
     *  https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     */
    public function up(): void
    {
        //Acessa o IF se não existir a tabela no DB
        if (!$this->hasTable('ads')) {
            $table = $this->table('ads');
            $table->addColumn('name', 'string', ['null' => false])
                ->addColumn('email', 'string', ['null' => false])
                ->addColumn('username', 'string', ['null' => false])
                ->addColumn('password', 'string', ['null' => false])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp')
                ->create();
        }
    }

    //Método Down para Reverter a Migrate caso Necessario
    public function down(): void
    {
        //Apagar a tabela AMDS_USERS
        $this->table('ads')->drop()->save();
    }
}
