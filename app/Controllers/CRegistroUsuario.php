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
                if ($this->validateData($formData, [
                    'dni' => 'required|min_length[9]|max_length[9]',
                    'nombre' => 'required|min_length[3]|max_length[75]',
                    'ap1' => 'required|min_length[2]|max_length[75]',
                    'ap2' => 'required|min_length[2]|max_length[75]',
                    'email' => 'required|min_length[3]|max_length[75]',
                    'telefono' => 'required|min_length[9]|max_length[9]',
                ])) {
                    if ($this->modeloUsuarios->where('dni', $formData['dni'])->countAllResults() > 0) {
                        throw new Exception("Ya existe un usuario con ese DNI");
                    }
                    if ($this->modeloUsuarios->where('email', $formData['email'])->countAllResults() > 0) {
                        throw new Exception("Ya existe un usuario con ese email");
                    }
                } else {
                    throw new Exception("Campos con valores incorrectos");
                }


                //hashear contraseña
                $formData->pass = password_hash($formData->pass, PASSWORD_BCRYPT);

                $this->modeloUsuarios->insert($formData);
            } catch (Exception $e) {
                $this->db->transRollback();
                $data['err'] = $e->getMessage();
                $data['form'] = $formData;
                return $this->cargar_vista('pages/vregistro', $data);
            }
            $this->db->transCommit();
            return redirect()->to(site_url('Login'));

        }
        return $this->cargar_vista('pages/vregistro', []);
    }
}
