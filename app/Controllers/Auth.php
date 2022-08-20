<?php

namespace App\Controllers;
use App\Models\UsersModel;


class Auth extends BaseController {

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        return redirect()->to(site_url('login'));
    }

    public function login()
    {
        if (!session('level')) {
            return view('auth/login');
        }

        return $this->redirectSiteLevel(session('level'));
    }

    public function prosesLogin()
    {
        $data = $this->request->getPost();

        if ($user = $this->userModel->getUser($data)) {

            if (password_verify($data['password'], $user->password)) {
                $params = [
                    'id_user'   => $user->id_user,
                    'username'   => $user->username,
                    'level'   => $user->level,
                ];

                session()->set($params);
                return $this->redirectSiteLevel(session('level'));

            } else {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }

        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan');
        }

    }

    public function redirectSiteLevel($level)
    {
        if ($level == "kalab") {
            return redirect()->to(site_url('kalab'));
        } else if ($level == "laboran") {
            return redirect()->to(site_url('laboran'));
        } else {
            return redirect()->to(site_url('peminjam'));
        }
    }

    public function register()
    {
        return view('auth/registrasi');
    }

    public function prosesRegister()
    {
        $data = $this->request->getPost();
        
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['level'] = 'peminjam';

        if (!$user = $this->userModel->getUser($data)) {

            if ($this->userModel->insert($data)) {
                return redirect()->to(site_url('login'))->with('success', 'Berhasil mendaftar');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal Mendaftar');
            }

        } else {
            return redirect()->back()->with('error', 'Username Sudah Ada. Silakan Buat Username Baru');
        }
    }

    public function logout()
    {
        $params = ['id_user', 'level', 'username'];
        session()->remove($params);
        return redirect()->to(site_url('login'));
    }
}