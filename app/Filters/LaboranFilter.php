<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LaboranFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('level') == 'laboran') {
            return redirect()->to(site_url('laboran'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}