<?php

use Migrations\AbstractMigration;

/**
 * Class RemoveErrorText
 */
class RemoveErrorText extends AbstractMigration
{
    public $autoId = false;

    public function up()
    {
        $this->table('plans')
            ->removeColumn('error_text')
            ->update();
    }

    public function down()
    {
        $this->table('plans')
            ->addColumn('error_text', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->update();
    }
}
