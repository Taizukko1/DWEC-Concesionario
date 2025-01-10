<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloCoches;
use App\Models\ModeloImagenes;
use App\Models\ModeloUnidades;
use App\Models\ModeloVentas;
use Exception;
use ReflectionException;

class CUnidades extends BaseController
{
    protected $modeloUnidades;
    protected $modeloImagenes;
    protected $modeloCoches;
    protected $modeloVentas;
    public function __construct()
    {
        $this->modeloUnidades = new ModeloUnidades();
        $this->modeloImagenes = new ModeloImagenes();
        $this->modeloCoches = new ModeloCoches();
        $this->modeloVentas = new ModeloVentas();
    }
    public function index()
    {
        $datos['unidades'] = $this->modeloUnidades->findAll();
        return $this->cargar_vista('pages/vunidades', $datos);
    }

    public function unidad($matricula)
    {
        $datos['unidad'] = $this->modeloUnidades->getUnidad($matricula)[0];
        $datos['coche'] = $this->modeloCoches->getModelo($datos['unidad']->id_coche);
        $datos['imagenes'] = $this->modeloImagenes->getImagenes($matricula);
        return $this->cargar_vista('pages/vunidad', $datos);
    }

    public function admin()
    {
        $uds_min = 2;
        //Validar si el usuario es admin
        if (!$this->autentificar(0)) return redirect()->to(site_url());
        //Consultar coches que tengan X unidades sin vender
        $ventas = $this->modeloVentas->select('matricula')->findAll();
        $unidades = $this->modeloUnidades->findAll();
        $disponibles = [];
        foreach ($unidades as $unidad) {
            if (!in_array($unidad->matricula, $ventas)) {
                if ((int) $this->modeloUnidades->selectCount('id_coche')->first()->id_coche > $uds_min)
                    $disponibles[] = $unidad;
            }
        }
        $data['disponibles'] = $disponibles;
        $data['test'] = "";
        return $this->cargar_vista('pages/admin/vtablaunidades', $data);
    }

    public function rebaja()
    {
        if ($this->request->is('post')) {
            $formData = $this->request->getPost();
            //Validar formulario
            if ($formData['descuento'] > 75 || $formData['descuento'] < 0) {
                return $this->admin();
            }
            if(!isset($formData['matriculas'])) {
                return $this->admin();
            }
            $this->db->transBegin();
            try {
                foreach ($formData['matriculas'] as $matricula) {
                    //Cargar unidad
                    $unidad = $this->modeloUnidades->where('matricula', $matricula)->first();
                    //recalcular precio
                    $precio = $unidad->precio - $unidad->precio * ($formData['descuento'] / 100);
                    $unidad->precio = $precio;
                    //Actualizar
                    $result = $this->modeloUnidades->update($matricula, $unidad);
                }
            } catch (ReflectionException $e) {
                return redirect()->to(site_url());
            }
        }
        //return $this->admin();
    }
}
