<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Messages extends AbstractMigration
{
    public function up(): void
    {
        if (!$this->hasTable('messages')) {
            $table = $this->table('messages');
            $table->addColumn('sender_id', 'integer', ['null' => false, 'signed' => false])
                ->addColumn('receiver_id', 'integer', ['null' => false, 'signed' => false])
                ->addColumn('message', 'text', ['null' => false])
                ->addColumn('is_read', 'boolean', ['default' => false])
                ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
                ->addIndex(['sender_id'], ['name' => 'idx_sender'])
                ->addIndex(['receiver_id'], ['name' => 'idx_receiver'])
                ->addForeignKey('sender_id', 'ads', 'id', [
                    'delete' => 'CASCADE',
                    'update' => 'NO_ACTION',
                    'constraint' => 'fk_messages_sender'
                ])
                ->addForeignKey('receiver_id', 'ads', 'id', [
                    'delete' => 'CASCADE',
                    'update' => 'NO_ACTION',
                    'constraint' => 'fk_messages_receiver'
                ])
                ->create();
        }
    }

    public function down(): void
    {
        $this->table('messages')->drop()->save();
    }
}
