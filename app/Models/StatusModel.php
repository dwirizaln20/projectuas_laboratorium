<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table            = 'status';
    protected $primaryKey       = 'kode_status';
    protected $allowedFields    = ['kode_status', 'id_peminjaman', 'acc_laboran', 'acc_kalab'];

    public function setAccKalab($kode_status, $value = null)
    {
        $this->db->table('status')
                 ->set('acc_kalab', $value)
                 ->where('kode_status', $kode_status)
                 ->update();

        return $this->db->affectedRows();
    }

}
