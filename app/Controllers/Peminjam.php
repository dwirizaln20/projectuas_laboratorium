<?php

namespace App\Controllers;
use App\Models\JadwalModel;
use App\Models\PeminjamanModel;
use App\Models\RuanganModel;

class Peminjam extends BaseController
{
    public function __construct()
    {
        $this->jadwal = new JadwalModel();
        $this->peminjaman = new PeminjamanModel();
        $this->ruangan = new RuanganModel();
        helper(['custom']);
    }

    public function index()
    {
        return view('peminjam/index');
    }

    public function formPinjam()
    {
        $data = [
            'ruangan'    => $this->ruangan->findAll()
        ];

        return view('peminjam/form_pinjam', $data);
    }

    public function save()
    {
        $data = $this->request->getPost();

        if (isset($_FILES['surat_pengantar'])) {
            $surat_pengantar = $this->request->getFile('surat_pengantar');
            $fileName = $surat_pengantar->getRandomName();
            $data['surat_pengantar'] = $fileName;
        }

        if ($this->peminjaman->insert($data)) {
            if (isset($_FILES['surat_pengantar']))
                $surat_pengantar->move('upload/berkas/', $fileName);
            return redirect()->to(site_url('peminjam/riwayat/verifikasi'))->with('success', 'Berhasil diajukan');
        } else {
            return redirect()->to(site_url('peminjam/riwayat/verifikasi'))->with('error', 'Gagal diajukan');
        }

    }

    public function edit($id_peminjaman)
    {
        $data = [
            'peminjam'  => $this->peminjaman->find($id_peminjaman),
            'ruangan'    => $this->ruangan->findAll()
        ];

        return view('peminjam/edit', $data);
    }

    public function update($id_peminjaman)
    {
        $data = $this->request->getPost();

        if (isset($_FILES['surat_pengantar'])) {
            $surat_pengantar = $this->request->getFile('surat_pengantar');
            $fileName = $surat_pengantar->getRandomName();
            $data['surat_pengantar'] = $fileName;
        }

        if ($this->peminjaman->update($id_peminjaman, $data)) {
            if (isset($_FILES['surat_pengantar']))
                $surat_pengantar->move('upload/berkas/', $fileName);

            return redirect()->to(site_url('peminjam/riwayat/verifikasi'))->with('success', 'Berhasil Diubah');
        } else {
            return redirect()->to(site_url('peminjam/riwayat/verifikasi'))->with('error', 'Gagal Diubah');
        }

    }

    public function riwayat($req)
    {
        if ($req == 'ditolak') {
            session()->set('all_btn_delete', true);
        } else {
            session()->remove('all_btn_delete');
        }

        $data = [
            'peminjaman'    => $this->peminjaman->getDataByStatus($req, session('id_user')),
            'ruangan'       => $this->ruangan->findAll(),
        ];
        return view('peminjam/riwayat', $data);
    }
 
    public function detail($id_peminjaman)
    {
        $data = [
            'peminjam'  => $this->peminjaman->find($id_peminjaman),
            'ruangan'    => $this->ruangan->findAll(),
            'jadwal'   => $this->jadwal->getJadwalByPeminjaman($id_peminjaman)
        ];

        return view('peminjam/detail', $data);
    }

    public function batalkanPermohonan($id_peminjaman)
    {
        if ($this->peminjaman->where('id_peminjaman', $id_peminjaman)->delete()) {
            return redirect()->to(site_url('peminjam/riwayat/verifikasi'))->with('success', 'Berhasil Dibatalkan');
        } else {
            return redirect()->to(site_url('peminjam/riwayat/verifikasi'))->with('error', 'Gagal Dibatalkan');
        }

    }

    public function hapusSemua($value, $id_user)
    {
        if ($value == 'ditolak') {
            $status = "peminjaman ditolak";
        }

        if ($this->peminjaman->where('id_user', $id_user)->where('kode_status', $status)->delete()) {
            return redirect()->to(site_url('peminjam/riwayat/ditolak'))->with('success', 'Berhasil Dihapus');
        } else {
            return redirect()->to(site_url('peminjam/riwayat/ditolak'))->with('error', 'Gagal Dihapus');
        }
    }

    public function contohSurat()
    {
        return $this->response->download('upload/contoh/cth-surat-peminjam.jpg', null);
    }

    public function downloadBukti($id_pinjam)
    {
        $data = $this->peminjaman->find($id_pinjam);
        return $this->response->download('upload/berkas/' . $data->surat_pengantar, null);
    }

    public function downloadSuratBalasan($id_pinjam)
    {
        $data = $this->peminjaman->find($id_pinjam);
        return $this->response->download('upload/bukti/' . $data->bukti_peminjaman, null);
    }

}
