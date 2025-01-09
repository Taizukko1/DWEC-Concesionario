<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloUsuarios;
class CLogin extends BaseController
{
    protected $modeloUsuarios;
    function __construct()
    {
        $this->modeloUsuarios = new ModeloUsuarios;
    }
    public function index()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getPost('email');
            $pwd = $this->request->getPost('pass');
            //Campos vacios
            if ($email === "" || $pwd === "") {
                $data["err"] = "Debes rellenar todos los campos";
                return $this->cargar_vista('pages/vlogin', $data);
            }
            //Usuario no existe
            if ($this->modeloUsuarios->where('email', $email)->countAllResults() < 1) {
                $data["err"] = "El usuario no existe";
                return $this->cargar_vista('pages/vlogin', $data);
            }
            //Contraseña incorrecta
            if (password_verify($pwd, $this->modeloUsuarios->where('email', $email)->findColumn('pass')[0]) === 1) {
                $data["err"] = "Contraseña incorrecta";
                return $this->cargar_vista('pages/vlogin', $data);
            }
            $id = $this->modeloUsuarios->where('email', $email)->findColumn('uid')[0];
            switch ($this->modeloUsuarios->getTipo($id)) {
                case 'admin':
                    $this->session->set('admin', ["id" => $id,"commits" => []]);
                    break;
                case 'vendedor':
                    $this->session->set('vendedor', ["id" => $id,"ventas" => $this->modeloUsuarios->getVentas($id)]);
                    break;
                default:
                    $this->session->set('user', ["id" => $id,"gastado" => $this->modeloUsuarios->getGasto($id)]);
                    break;
            }
            return redirect()->to(site_url());
        } else {
            return $this->cargar_vista('pages/vlogin', []);
        }
    }

    function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url());
    }
}
