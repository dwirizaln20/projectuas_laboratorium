<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peminjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peminjaman'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nama_peminjam' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'status_peminjam' => [
                'type'       => 'ENUM',
                'constraint' => ['dosen', 'mahasiswa']
            ],
            'no_identitas' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'no_telepon' => [
                'type'       => 'VARCHAR',
                'constraint' => 50
            ],
            'asal_peminjam' => [
                'type'       => 'ENUM',
                'constraint' => ['luar prodi', 'dalam prodi']
            ],
            'surat_pengantar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'      => true,
                'default'   => null
            ],
            'id_ruangan'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'kapasitas'       => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'tgl_awal_pinjam'       => [
                'type'           => 'DATE'
            ],
            'tgl_akhir_pinjam'       => [
                'type'           => 'DATE'
            ],
            'kegiatan' => [
                'type'       => 'TEXT',
            ],
            'kode_status' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'      => true,
                'default'   => null
            ],
            'bukti_peminjaman' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'      => true,
                'default'   => null
            ],
        ]);
        $this->forge->addKey('id_peminjaman', true);
        $this->forge->createTable('peminjaman');
    }

    public function down()
    {
        $this->forge->dropTable('peminjaman');
    }
}
