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
                if (! $this->validateData($data, [
                    'nombre' => 'required|min_length[3]|max_length[75]',
                    'ap1' => 'required|min_length[3]|max_length[75]',
                    'ap2' => 'required|min_length[3]|max_length[75]',
                    'email' => 'required|min_length[3]|max_length[75]',
                    'telefono' => 'required|min_length[3]|max_length[75]',
                ])) {
                    $this->db->transBegin();
                    try {
                        $this->modeloUsuarios->insert($data);
                        $lastID = $this->modeloUsuarios->selectMax('id')->first();
                        if ($data->tipo === 'vendedor') {
                            $vendedor = [
                                'uid' => $lastID->id,
                                'ventas' => 0
                            ];
                            $this->modeloVendedores->insert($vendedor);
                        }

                        if ($data->tipo === 'cliente') {
                            $cliente = [
                                'uid' => $lastID->id,
                                'ventas' => 0
                            ];
                            $this->modeloClientes->insert($cliente);
                        }
                        $this->db->transCommit();
                    } catch (\PDOException $e) {
                        $this->db->transRollback();
                    }
                    $this->db->transComplete();
                    return redirect()->to(site_url('admin/Usuarios'));
                }
            }
            $datos["usuarios"] = $this->modeloUsuarios->findAll();
            return $this->cargar_vista(['pages/admin/vusuarios', 'pages/admin/vnewusuario'], $datos);
        }

        return redirect()->to(site_url());
    }
}
