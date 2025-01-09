<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloCoches;
use App\Models\ModeloUnidades;
use App\Models\ModeloVentas;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class CVentas extends BaseController
{
    protected $modeloVentas;
    protected $modeloUnidades;
    protected $modeloCoches;
    public function __construct() {
        $this->modeloVentas = new ModeloVentas();
        $this->modeloUnidades = new ModeloUnidades();
        $this->modeloCoches = new ModeloCoches();
    }
    public function index()
    {
        $data["ventas"] = $this->modeloVentas->findAll();
        return $this->cargar_vista('pages/admin/vventas', $data);
    }

    public function comprar($matricula) {
        $id = $this->modeloUnidades->getUnidad($matricula)[0]->id_coche;
        $data["coche"] = $this->modeloCoches->where('id_coche', $id)->first();
        $this->db->transBegin();
        try {
            $venta = [
                "uid_cliente" => $this->session->get("user")["id"],
                "matricula" => $matricula
            ];
            //insert
            $this->modeloVentas->insert($venta);
        } catch(Exception $e) {
            return redirect()->to(site_url("error"));
        }
        $this->db->transComplete();
        return $this->cargar_vista('pages/vcompra', $data);
    }

    public function tramitar() {

    }
}
