<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CRegistroUsuario extends BaseController
{
    public function index()
    {
        return $this->cargar_vista('pages/vregistro', []);
    }
}
