<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Status extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kode_status'          => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
            ],
            'id_peminjaman'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'acc_laboran' => [
                'type'       => 'ENUM',
                'constraint' => ['acc', 'tolak'],
                'default'    => null
            ],
            'acc_kalab' => [
                'type'       => 'ENUM',
                'constraint' => ['acc', 'tolak'],
                'default'    => null
            ]
        ]);
        $this->forge->addKey('kode_status', true);
        $this->forge->createTable('status');
    }

    public function down()
    {
        $this->forge->dropTable('status');
    }
}
