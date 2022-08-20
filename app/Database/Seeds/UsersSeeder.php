<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data =[
            [
                'id_user'        => '1',
                'username'      => 'kalab',
                'password'      => password_hash('123', PASSWORD_BCRYPT),
                'level'         => 'kalab'
            ],
             [
                'id_user'        => '2',
                'username'      => 'laboran',
                'password'      => password_hash('123', PASSWORD_BCRYPT),
                'level'         => 'laboran'
            ],
             [
                'id_user'        => '3',
                'username'      => 'peminjam',
                'password'      => password_hash('123', PASSWORD_BCRYPT),
                'level'         => 'peminjam'
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
