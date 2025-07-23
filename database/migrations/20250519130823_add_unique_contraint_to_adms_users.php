<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddUniqueContraintToAdmsUsers extends AbstractMigration
{

    public function up(): void
    {
        if ($this->hasTable('ads')) {
            $table = $this->table('ads');
            $table->addIndex(['email'], ['unique' => true, 'name' => 'idx_unique_email'])
                ->update();
        }
    }


    public function down(): void
    {
        $table = $this->table('ads');
        $table->removeIndexByName('idx_unique_email')
            ->update();
    }
}
