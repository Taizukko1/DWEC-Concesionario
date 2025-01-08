<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModeloClientes;
use App\Models\ModeloUsuarios;
use App\Models\ModeloVendedores;

class CUsuarios extends BaseController
{
    protected $modeloUsuarios;
    protected $modeloVendedores;
    protected $modeloClientes;
    public function __construct()
    {
        $this->modeloUsuarios = new ModeloUsuarios();
        $this->modeloVendedores = new ModeloVendedores();
        $this->modeloClientes = new ModeloClientes();
    }
    public function index()
    {
        if ($this->session->get('admin') != null) {
            $datos["usuarios"] = $this->modeloUsuarios->findAll();
            return $this->cargar_vista('pages/admin/vusuarios', $datos);
        }

        return redirect()->to(site_url());
    }

    public function new()
    {
        $datos['form'] = [];
        if ($this->session->get('admin') != null) {
            if ($this->request->is('post')) {
                $data = $this->request->getPost();
                $datos['form'] = $data;
                if ($this->validateData($data, [
                    'nombre' => 'required|min_length[3]|max_length[75]',
                    'ap1' => 'required|min_length[2]|max_length[75]',
                    'ap2' => 'required|min_length[2]|max_length[75]',
                    'email' => 'required|min_length[3]|max_length[75]',
                    'telefono' => 'required|min_length[3]|max_length[75]',
                ])) {
                    $this->db->transBegin();
                    try {
                        $usuario = [
                            'email' => $data['email'],
                            'tipo' => $data['tipo'],
                            'dni' => $data['dni'],
                            'nombre' => $data['nombre'],
                            'ap1' => $data['ap1'],
                            'ap2' => $data['ap2'],
                            'telefono' => $data['telefono']
                        ];
                        $this->modeloUsuarios->insert($usuario);
                        $lastID = $this->modeloUsuarios->selectMax('uid')->first();
                        if ($usuario["tipo"] === 'vendedor') {
                            $vendedor = [
                                'uid' => $lastID->uid,
                                'ventas' => 0
                            ];
                            $this->modeloVendedores->insert($vendedor);
                        }

                        if ($usuario["tipo"] === 'cliente') {
                            $cliente = [
                                'uid' => $lastID->uid,
                                'gastado' => 0
                            ];
                            $this->modeloClientes->insert($cliente);
                        }
                        $this->db->transCommit();
                    } catch (\PDOException $e) {
                        $this->db->transRollback();
                        $datos['form'] = $e->getMessage();
                    }
                    $this->db->transComplete();
                    return redirect()->to(site_url('admin/Usuarios'));
                } else {
                    $datos["err"] = "uno o mas campos incorrectos...";
                }
            }
            $datos["usuarios"] = $this->modeloUsuarios->findAll();
            return $this->cargar_vista(['pages/admin/vusuarios', 'pages/admin/vnewusuario'], $datos);
        }

        return redirect()->to(site_url());
    }

    public function filtrado($num)
    {
        $tipo = "";
        switch ($num) {
            case '0':
                $tipo = 'admin';
                break;
            case '1':
                $tipo = 'vendedor';
                break;
            case '2':
                $tipo = 'cliente';
                break;
        }
        if ($this->session->get('admin') != null) {
            $datos["usuarios"] = $this->modeloUsuarios->where('tipo', $tipo)->findAll();
            return $this->cargar_vista('pages/admin/vusuarios', $datos);
        }

        return redirect()->to(site_url());
    }

    public function update($uid)
    {
        //Encontrar usuario para poblar inputs
        $usuario = $this->modeloUsuarios->where('uid', $uid)->first();
        //agregar atributo de tipo (vendedor/cliente)
        if ($usuario->tipo === 'vendedor') {
            $usuario->value = $this->modeloVendedores->getVentas($uid);
            $usuario->attr = 'ventas';
        } else if ($usuario->tipo === 'cliente') {
            $usuario->value = $this->modeloClientes->getGasto($uid);
            $usuario->attr = 'gastado';
        }
        $data['edited'] = $usuario;
        $data['usuarios'] = $this->modeloUsuarios->findAll();
        return $this->cargar_vista(['pages/admin/vusuarios', 'pages/admin/vupdateusuario'], $data);
    }

    public function delete($uid)
    {
        //Encontrar usuario
        $usuario = $this->modeloUsuarios->where('uid', $uid)->first();
        //Borrar Vendedor/Cliente
        if ($usuario->tipo === 'cliente') {
            $this->modeloClientes->where('uid', $uid)->delete();
        } else if ($usuario->tipo === 'vendedor') {
            $this->modeloVendedores->where('uid', $uid)->delete();
        }
        //Borrar Usuario
        $this->modeloUsuarios->where('uid', $uid)->delete();
        return redirect()->to(site_url("admin/Usuarios"));
    }
}
