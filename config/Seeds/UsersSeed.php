<?php

use Migrations\AbstractSeed;

/**
 * Class UsersSeed
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'username' => 'admin',
                'password' => '$2y$10$Pr3LbsP2E7ULVF2S3KhUi.Cl2yQdfp9rkRDIGb38o8lHBXIDk5hp2',
                'role' => 'admin',
                'created' => '2017-10-23 12:26:38',
                'modified' => '2017-10-23 12:26:38',
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
