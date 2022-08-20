<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run()
    {
        $data =[
            ['nama_ruangan'      => 'Laboratorium 1'],
            ['nama_ruangan'      => 'Laboratorium 2'],
            ['nama_ruangan'      => 'Laboratorium 3'],
            ['nama_ruangan'      => 'Laboratorium 4'],
            ['nama_ruangan'      => 'Laboratorium 5']
        ];

        $this->db->table('ruangan')->insertBatch($data);
    }
}
