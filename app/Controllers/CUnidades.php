<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloCoches;
use App\Models\ModeloImagenes;
use App\Models\ModeloUnidades;
use CodeIgniter\HTTP\ResponseInterface;

class CUnidades extends BaseController
{
    protected $modeloUnidades;
    protected $modeloImagenes;
    protected $modeloCoches;
    public function __construct() {
        $this->modeloUnidades = new ModeloUnidades();
        $this->modeloImagenes = new ModeloImagenes();
        $this->modeloCoches = new ModeloCoches();
    }
    public function index()
    {
        $datos['unidades'] = $this->modeloUnidades->findAll();
        return $this->cargar_vista('pages/vunidades', $datos);
    }

    public function unidad($matricula) {
        $datos['unidad'] = $this->modeloUnidades->getUnidad($matricula)[0];
        $datos['coche'] = $this->modeloCoches->getModelo($datos['unidad']->id_coche);
        $datos['imagenes'] = $this->modeloImagenes->getImagenes($matricula);
        return $this->cargar_vista('pages/vunidad', $datos);
    }
}
