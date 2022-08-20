<?php

namespace App\Controllers;
use App\Models\PeminjamanModel;
use App\Models\JadwalModel;
use App\Models\RuanganModel;
use App\Models\StatusModel;

use CodeIgniter\I18n\Time;
 

class Laboran extends BaseController
{
    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->jadwal = new JadwalModel();
        $this->ruangan = new RuanganModel();
        $this->status = new StatusModel();

        helper(['custom']);
    }

    public function index()
    {
        return view('laboran/index');
    }

    public function riwayat($req)
    {
        if ($req == 'ditolak') {
            session()->set('all_btn_delete', true);
        } else {
            session()->remove('all_btn_delete');
        }

        $data = [
            'peminjaman'    => $this->peminjaman->getDataByStatus($req),
            'ruangan'       => $this->ruangan->findAll(),
            'jadwal'        => $this->jadwal->findAll(),
            'status'        => $this->status->findAll()
        ];
        return view('laboran/riwayat', $data);
    }

    public function detail($id_peminjaman)
    {
        $data = [
            'peminjam'  => $this->peminjaman->find($id_peminjaman),
            'ruangan'    => $this->ruangan->findAll(),
            'jadwal'   => $this->jadwal->getJadwalByPeminjaman($id_peminjaman)
        ];

        return view('laboran/detail', $data);
    }

    public function penjadwalan($id_peminjaman)
    {
        $peminjam = $this->peminjaman->getPeminjamanByIdPinjam($id_peminjaman);
        $data = [
            'peminjam'    => $peminjam,
            'jadwal'    => $this->jadwal->getJadwalByIdRuangan($peminjam->id_ruangan),
            'ruangan'    => $this->ruangan->findAll(),
        ];

        return view('laboran/penjadwalan', $data);
    }

    public function jadwalkan()
    {
        $data = $this->request->getPost();

        $this->jadwal->insert($data);

        if ($this->peminjaman->setKodeStatus($data['id_peminjaman'], 'dijadwalkan') > 0) {
            return redirect()->to(site_url('laboran/riwayat/verifikasi'))->with('success', 'Berhasil Dijadwalkan');
        } else {
            return redirect()->to(site_url('laboran/riwayat/verifikasi'))->with('error', 'Gagal Dijadwalkan');
        }

    }

    public function downloadBukti($id_pinjam)
    {
        $data = $this->peminjaman->find($id_pinjam);
        return $this->response->download('upload/berkas/' . $data->surat_pengantar, null);
    }

    public function tolakPermohonan($id_peminjaman)
    {
        if ($this->peminjaman->setKodeStatus($id_peminjaman, 'peminjaman ditolak') > 0) {
            return redirect()->to(site_url('laboran/riwayat/ditolak'))->with('warning', 'Peminjaman Berhasil Ditolak');
        } else {
            return redirect()->to(site_url('laboran/riwayat/verifikasi'))->with('error', 'Peminjaman Gagal Ditolak');
        }
    }

    public function serahkanKalab($id_peminjaman, $id_jadwal)
    {
        $kode_status = date('Ymd') ."-". $id_peminjaman."-".$id_jadwal;

        $data = [
            'kode_status'   => $kode_status,
            'id_peminjaman'     => $id_peminjaman,
            'acc_laboran'   => 'acc'
        ];

        if ($this->peminjaman->setKodeStatus($id_peminjaman, $kode_status) > 0) {
            $this->status->insert($data);
            return redirect()->to(site_url('laboran/riwayat/verifikasi'))->with('success', 'Berhasil diserahkan ke kalab');
        } else {
            return redirect()->to(site_url('laboran/riwayat/verifikasi'))->with('error', 'Gagal diserahkan ke kalab');
        }

    }

    public function jadwal()
    {
        $data = [
            'jadwal'    => $this->jadwal->getAll(),
            'ruangan'   => $this->ruangan->findAll(),
            'tgl_sekarang' => Time::parse(date('Y-m-d'))
        ];

        return view('laboran/jadwal', $data);
    }

    public function hapusJadwal($id_jadwal, $id_peminjaman)
    {
        if ($this->jadwal->delete($id_jadwal)) {
            $this->peminjaman->delete($id_peminjaman);
            $this->status->where('id_peminjaman', $id_peminjaman)->delete();

            return redirect()->to(site_url('laboran/jadwal'))->with('success', 'Jadwal Dihapus');
        } else {
            return redirect()->to(site_url('laboran/jadwal'))->with('error', 'Jadwal Gagal Dihapus');
        }
    }

    public function downloadSuratBalasan($id_pinjam)
    {
        $data = $this->peminjaman->find($id_pinjam);
        return $this->response->download('upload/bukti/' . $data->bukti_peminjaman, null);
    }

    public function hapusSemua($value)
    {
        if ($value == 'ditolak') {
            $status = "peminjaman ditolak";
        }

        if ($this->peminjaman->where('kode_status', $status)->delete()) {
            return redirect()->to(site_url('laboran/riwayat/ditolak'))->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->to(site_url('laboran/riwayat/ditolak'))->with('error', 'Gagal Dihapus');
        }
    }
}
