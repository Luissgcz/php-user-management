<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class RecoveryPassword extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        if ($this->hasTable('ads')) {
            $table = $this->table('ads');
         
            $table->addColumn('recovery_password', 'string', [
                'null' => true,
                'after' => 'password'
            ])
                ->addColumn('validate_recovery_password', 'datetime', [
                    "null" => true,
                    "after" => 'recovery_password'
                ])
                ->update();
        }
    }


    public function down(): void
    {
        if ($this->hasTable('ads')) {       
            $this->table('ads')->removeColumn('validate_recovery_password')->removeColumn('recovery_password')->update();
        }
    }
}
