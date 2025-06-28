<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddUniqueContraintToAdmsUsers extends AbstractMigration
{

    public function up(): void
    {
        if ($this->hasTable('ads')) {
            $table = $this->table('ads');
            //Adicionar Indices Unicos as Colunas email e username
            // 'name' => 'idx_unique_username||email' - Nomea o Indice Unico
            $table->addIndex(['email'], ['unique' => true, 'name' => 'idx_unique_email'])
                ->addIndex(['username'], ['unique' => true, 'name' => 'idx_unique_username'])
                ->update();
        }
    }


    public function down(): void
    {
        $table = $this->table('ads');
        //Remover os Indices Unicos
        $table->removeIndexByName('idx_unique_email')
            ->removeIndexByName('idx_unique_username')
            ->update();
    }
}
