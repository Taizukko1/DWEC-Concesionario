<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloVentas;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class CVentas extends BaseController
{
    protected $modeloVentas;
    public function __construct() {
        $this->modeloVentas = new ModeloVentas();
    }
    public function index()
    {
        $data["ventas"] = $this->modeloVentas->findAll();
        return $this->cargar_vista('pages/admin/vventas', $data);
    }

    public function comprar($matricula) {
        $this->db->transBegin();
        try {
            $venta = [
                "uid_cliente" => $this->session->get("user")["id"],
                "matricula" => $matricula
            ];
        } catch(Exception $e) {
            return redirect()->to(site_url("error"));
        }
        $this->db->transComplete();
    }

    public function tramitar() {

    }
}
