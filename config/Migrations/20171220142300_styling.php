<?php

use Migrations\AbstractMigration;

/**
 * Class Initial
 */
class Initial extends AbstractMigration
{
    public $autoId = false;

    public function up()
    {

        $this->table('plans')
            ->addColumn('tile_size', 'string', [
                'default' => null,
                'limit' => 32,
                'null' => false,
                'signed' => false,
            ])
            ->update();
    }

    public function down()
    {
        $this->table('plans')
            ->dropForeignKey(
                'category_id'
            )
            ->dropForeignKey(
                'server_id'
            );

        $this->dropTable('categories');
        $this->dropTable('servers');
        $this->dropTable('plans');
        $this->dropTable('users');
        $this->dropTable('sessions');
    }
}
