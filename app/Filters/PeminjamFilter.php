<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PeminjamFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('level') == 'peminjam') {
            return redirect()->to(site_url('peminjam'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}