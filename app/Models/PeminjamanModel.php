<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_peminjaman';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['id_user', 'nama_peminjam', 'status_peminjam', 'no_identitas', 'no_telepon', 'asal_peminjam', 'surat_pengantar', 'id_ruangan', 'kapasitas', 'tgl_awal_pinjam', 'tgl_akhir_pinjam', 'kode_status' ,'kegiatan'];

    // validasi
    // protected $validationRules    = [
    //     'surat_pengantar'     => 'uploaded[berkas]|mime_in[berkas,image/jpg,image/jpeg,image/gif,image/png]|max_size[berkas,2048]' 
    // ];
    // protected $validationMessages = [
    //     'surat_pengantar'        => [
    //         'uploaded' => 'Harus Ada File yang diupload',
    //         'mime_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
    //         'max_size' => 'Ukuran File Maksimal 2 MB'
    //     ]
    // ];

    public function getDataByStatus($req, $id_user = null)
    {
        $status = "";
        $where = "";
        $builder = $this->db->table('peminjaman');

        if ($req == "acc") {
            $status = "telah disetujui";
        } else if ($req == "ditolak") {
            $status = "peminjaman ditolak";
        } else {
            if (is_null($id_user)) {
                $where = "kode_status IS NULL OR ( kode_status != 'telah disetujui' AND kode_status != 'peminjaman ditolak' ) ";
            } else {
                $where = "id_user = " .$id_user. " AND (kode_status IS NULL OR ( kode_status != 'telah disetujui' AND kode_status != 'peminjaman ditolak' )) ";
            }
            $builder->where($where)
                    ->orderBy('id_peminjaman', 'DESC');
            return $builder->get()->getResult();
        }

        if (is_null($id_user)) {
            $builder->where('kode_status', $status)
                    ->orderBy('id_peminjaman', 'DESC');
        } else {
            $builder->where('id_user', $id_user)
                    ->where('kode_status', $status)
                    ->orderBy('id_peminjaman', 'DESC');
        }

        return $builder->get()->getResult();
    }

    public function getProsesKalab()
    {
        $builder = $this->db->table('peminjaman')
                            ->join('status', 'status.kode_status = peminjaman.kode_status')
                            ->orderBy('status.id_peminjaman', 'DESC');

        return $builder->get()->getResult();
    }

    public function getPeminjamanByIdPinjam($id_peminjaman)
    {
        $builder = $this->db->table('peminjaman');
        $builder->join('ruangan', 'ruangan.id_ruangan = peminjaman.id_ruangan')
                ->where(['id_peminjaman' => $id_peminjaman])
                ->orderBy('id_peminjaman', 'DESC');
        return $builder->get()->getRow();
    }

    public function setKodeStatus($id_peminjaman, $value = null)
    {
        $this->db->table('peminjaman')
             ->set('kode_status', $value)
             ->where('id_peminjaman', $id_peminjaman)
             ->update();
        return $this->db->affectedRows();
    }

    public function generateBuktiPeminjaman($data, $kode_status)
    {
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(ROOTPATH.'public\template_surat\template_bukti.docx');

        $templateProcessor->setValues([
            'id_peminjaman'     => $data['id_peminjaman'],
            'year'              => $data['year'],
            'nama'              => $data['nama_peminjam'],
            'no_telepon'        => $data['no_telepon'],
            'nama_ruangan'      => $data['nama_ruangan'],
            'tgl_awal_pinjam'   => $data['tgl_awal_pinjam'],
            'tgl_akhir_pinjam'  => $data['tgl_akhir_pinjam'],
            'jam_mulai'         => $data['jam_mulai'],
            'jam_akhir'         => $data['jam_akhir'],
            'now'               => $data['now'],
        ]);

        // header("Content-Disposition: attachment; filename=template.docx");

        $templateProcessor->saveAs(ROOTPATH . "\public\upload\bukti\bukti-" . $kode_status . ".docx");
        return "bukti-" .$kode_status. ".docx";
    }

    public function accPeminjaman($id_peminjaman, $bukti_peminjaman, $value = null)
    {
        $this->db->table('peminjaman')
                 ->set('kode_status', $value)
                 ->set('bukti_peminjaman', $bukti_peminjaman)
                 ->where('id_peminjaman', $id_peminjaman)
                 ->update();
        return $this->db->affectedRows();
    }

}

