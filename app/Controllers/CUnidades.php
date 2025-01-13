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
        $data['unidades'] = $unidades;
        $disponibles = [];
        foreach ($unidades as $unidad) {
            if (!in_array($unidad->matricula, $ventas)) {
                if ((int) $this->modeloUnidades->selectCount('id_coche')->first()->id_coche > $uds_min)
                    $disponibles[] = $unidad;
            }
        }
        $data['disponibles'] = $disponibles;
        $data['test'] = "";
        return $this->cargar_vista(['pages/admin/vtablaunidades', 'pages/admin/vunidadesrebaja'], $data);
    }

    public function add()
    {
        $modelosQuery = $this->modeloCoches->findAll();
        $data['modelos'] = [];
        foreach ($modelosQuery as $qr) {
            $data['modelos'][$qr->id_coche] = $qr->marca . " " . $qr->modelo . " " . $qr->anio_fabricacion;
        }
        $data['modelos'][0] = "Nuevo Modelo";
        if ($this->request->is('post')) {
            $data['form'] = $this->request->getPost();
            $this->db->transBegin();
            try {
                if (sizeof($data['form']['imagenes']) > 0) {
                    $unidad = [
                        "matricula" => $data['form']["matricula"],
                        "matricula" => $data['form']["id_coche"],
                        "matricula" => $data['form']["kilometraje"],
                        "matricula" => $data['form']["color"],
                        "matricula" => $data['form']["precio"],
                    ];
                    $this->modeloUnidades->insert($unidad);
                    foreach ($data['form']['imagenes'] as $url) {
                        $imagen = [
                            "matricula" => $data['form']['matricula'],
                            "url" => $url
                        ];
                        $this->modeloImagenes->insert($imagen);
                    }
                } else {
                    throw new Exception("No hay ninguna imagen");
                }
            } catch (Exception $e) {
                $data['err'] = $e->getMessage();
                $this->db->transRollback();
                return $this->cargar_vista('pages/admin/vnewunidad', $data);
            }
            $this->db->transCommit();
        }
        return $this->cargar_vista('pages/admin/vnewunidad', $data);
    }

    public function update($matricula)
    {
        $data['modelos'] = $this->modeloCoches->findAll();
        $data['unidad'] = $this->modeloUnidades->where('matricula', $matricula)->first();
        if ($this->request->is('post')) {
            $formData = $this->request->getPost();
            $this->db->transBegin();
            try {
                $this->modeloUnidades->update($matricula, $formData);
            } catch (ReflectionException $e) {
                $this->db->transRollback();
                $data['err'] = "Error al actualizar BD: " . $e->getMessage();
                return $this->cargar_vista('pages/admin/vupdateunidad', $data);
            }
            $this->db->transCommit();
        }
        return $this->cargar_vista('pages/admin/vupdateunidad', $data);
    }

    public function delete($matricula)
    {
        $this->modeloUnidades->where('matricula', $matricula)->delete();
        return redirect()->to(site_url('admin/Unidades'));
    }


    public function rebaja()
    {
        if ($this->request->is('post')) {
            $formData = $this->request->getPost();
            //Validar formulario
            if ($formData['descuento'] > 75 || $formData['descuento'] < 0) {
                return $this->admin();
            }
            if (!isset($formData['matriculas'])) {
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
                $this->db->transRollback();
                return redirect()->to(site_url());
            }
            $this->db->transCommit();
        }
        return $this->admin();
    }
}
