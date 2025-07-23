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
        if (!$this->hasTable('ads')) {
            $table = $this->table('ads');
            $table->addColumn('name', 'string', ['null' => false])
                ->addColumn('email', 'string', ['null' => false])
                ->addColumn('password', 'string', ['null' => false])
                ->addColumn('created_at', 'timestamp')
                ->addColumn('updated_at', 'timestamp')
                ->addColumn('image', 'string', ['null' => true])
                ->addColumn('phone', 'string', ['limit' => 20, 'null' => true])
                ->addColumn('status', 'enum', ['values' => ['ativo', 'inativo'], 'null' => true, 'default' => 'ativo'])
                ->create();
        }
    }

    public function down(): void
    {
        $this->table('ads')->drop()->save();
    }
}
