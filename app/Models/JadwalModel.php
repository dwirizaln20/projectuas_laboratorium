<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id_jadwal';
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_peminjaman', 'id_ruangan', 'jam_mulai', 'jam_akhir'];


    public function getAll()
    {
        $builder = $this->db->table('jadwal')
                    ->join('peminjaman', 'peminjaman.id_peminjaman = jadwal.id_peminjaman')
                    ->orderBy('id_jadwal', 'DESC');
        return $builder->get()->getResult();
    }

    public function getJadwalByPeminjaman($id_peminjaman)
    {
        $builder = $this->db->table('jadwal')->where('id_peminjaman', $id_peminjaman);
        return $builder->get()->getRow();
    }

    public function getJadwalByIdRuangan($id_ruangan)
    {
        $builder = $this->db->table('jadwal')
                    ->join('peminjaman', 'peminjaman.id_peminjaman = jadwal.id_peminjaman')
                    ->where('jadwal.id_ruangan', $id_ruangan);
        return $builder->get()->getResult();
    }

}
