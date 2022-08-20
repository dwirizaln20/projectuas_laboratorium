<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jadwal'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_peminjaman'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_ruangan'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'jam_mulai' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100'    
            ],
            'jam_akhir' => [
                'type'          => 'VARCHAR',
                'constraint'    => '100' 
            ]
        ]);
        $this->forge->addKey('id_jadwal', true);
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal');
    }
}
