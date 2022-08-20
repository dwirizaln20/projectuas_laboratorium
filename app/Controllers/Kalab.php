<?php

namespace App\Controllers;
require_once ROOTPATH . 'vendor/autoload.php';
use App\Models\PeminjamanModel;
use App\Models\RuanganModel;
use App\Models\StatusModel;
use App\Models\JadwalModel;

use CodeIgniter\I18n\Time;


class Kalab extends BaseController
{

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->ruangan = new RuanganModel();
        $this->status = new StatusModel();
        $this->jadwal = new JadwalModel();
        helper(['custom']);
    }

    public function index()
    {
        return view('kalab/index');
    }

    public function laporan()
    {
        $data = [
            'peminjaman'    => $this->peminjaman->getProsesKalab(),
            'ruangan'        => $this->ruangan->findAll(),
            'jadwal'   => $this->jadwal->findAll()
        ];

        return view('kalab/laporan', $data);
    }

    public function detail($id_peminjaman)
    {
        $data = [
            'peminjam'  => $this->peminjaman->find($id_peminjaman),
            'ruangan'    => $this->ruangan->findAll(),
            'jadwal'   => $this->jadwal->getJadwalByPeminjaman($id_peminjaman)
        ];

        return view('kalab/detail', $data);
    }

    public function downloadBukti($id_pinjam)
    {
        $data = $this->peminjaman->find($id_pinjam);
        return $this->response->download('upload/berkas/' . $data->surat_pengantar, null);
    }
 
    public function tolakPermohonan($id_peminjaman)
    {
        if ($this->peminjaman->setKodeStatus($id_peminjaman, 'peminjaman ditolak') > 0) {
            $this->jadwal->where('id_peminjaman', $id_peminjaman)->delete();
            $this->status->where('id_peminjaman', $id_peminjaman)->delete();

            return redirect()->to(site_url('kalab/laporan'))->with('warning', 'Peminjaman Berhasil Ditolak');
        } else {
            return redirect()->to(site_url('kalab/laporan'))->with('error', 'Peminjaman Gagal Ditolak');
        }
    }

    public function convertBulan($dt)
    {
        // $dt = 2019-10-02 ( Tahun-Bulan-Tanggal )

        $dateNow = explode('-', $dt);

        $bulan = [
            '01'    => 'Januari',
            '02'    => 'Februari',
            '03'    => 'Maret',
            '04'    => 'April',
            '05'    => 'Mei',
            '06'    => 'Juni',
            '07'    => 'Juli',
            '08'    => 'Agustus',
            '09'    => 'September',
            '10'    => 'Oktober',
            '11'    => 'September',
            '12'    => 'Desember'
        ];

        $data['bulan'] = '';
        foreach ($bulan as $key => $row) {
            if ($key == $dateNow[1]) {
                $data['bulan'] = $row;
            }
        }   

        // 02 Februari 2019 ( Y m d )
        return $dateNow[2]. " " .$data['bulan']. " " .$dateNow[0];
    }

    public function accPermohonan($id_peminjaman, $kode_status)
    {
        $data = $this->request->getPost();
        $data['id_peminjaman'] = $id_peminjaman;
        $data['tgl_awal_pinjam'] = $this->convertBulan($data['tgl_awal_pinjam']);
        $data['tgl_akhir_pinjam'] = $this->convertBulan($data['tgl_akhir_pinjam']);

        // 2022-10-02
        $dt = date('Y-m-d', strtotime(\CodeIgniter\I18n\Time::now()->toDateString()));
        $data['now'] = $this->convertBulan($dt);
    
        $dt = explode('-', $dt);
        $data['year'] = $dt[0];

        if ($this->status->setAccKalab($kode_status, 'acc') > 0) {

            $bukti = $this->peminjaman->generateBuktiPeminjaman($data, $kode_status);
            $this->peminjaman->accPeminjaman($id_peminjaman, $bukti, 'telah disetujui');

            return redirect()->to(site_url('kalab/laporan'))->with('success', 'Peminjaman Berhasil Disetujui');
        } else {
            return redirect()->to(site_url('kalab/laporan'))->with('error', 'Peminjaman Gagal Disetujui');
        }
    }

    public function jadwal()
    {
        $data = [
            'jadwal'    => $this->jadwal->getAll(),
            'ruangan'   => $this->ruangan->findAll(),
            'tgl_sekarang' => Time::parse(date('Y-m-d'))
        ];
        return view('kalab/jadwal', $data);
    }
}
