<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloUsuarios;
use Exception;

class CRegistroUsuario extends BaseController
{
    protected $modeloUsuarios;
    protected $modeloClientes;
    public function __construct()
    {
        $this->modeloUsuarios = new ModeloUsuarios();
    }
    public function index()
    {
        if ($this->request->is('post')) {
            $formData = $this->request->getPost();
            //Validar formulario
            $this->db->transBegin();
            try {
                if ($this->modeloUsuarios->where('dni', $formData->dni)->countAllResults() > 0) {
                    throw new Exception("Ya existe un usuario con ese DNI");
                }
                if ($this->modeloUsuarios->where('email', $formData->email)->countAllResults() > 0) {
                    throw new Exception("Ya existe un usuario con ese email");
                }

                $this->modeloUsuarios->insert($formData);
            } catch (Exception $e) {
                return $this->cargar_vista('pages/vregistro', ["err" => $e->getMessage()]);
            }
        }
        return $this->cargar_vista('pages/vregistro', []);
    }
}
