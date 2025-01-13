<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\EmailService;
use App\Models\ModeloCoches;
use App\Models\ModeloUnidades;
use App\Models\ModeloVentas;
use App\Models\ModeloUsuarios;
use ReflectionException;

class CVentas extends BaseController
{
    protected $modeloVentas;
    protected $modeloUnidades;
    protected $modeloCoches;
    protected $modeloUsuarios;
    protected $mailer;
    public function __construct()
    {
        $this->modeloVentas = new ModeloVentas();
        $this->modeloUnidades = new ModeloUnidades();
        $this->modeloCoches = new ModeloCoches();
        $this->modeloUsuarios = new ModeloUsuarios();
        $this->mailer = new EmailService();
    }
    public function index()
    {
        $data["ventas"] = $this->modeloVentas->findAll();
        return $this->cargar_vista('pages/admin/vventas', $data);
    }

    public function comprar($matricula)
    {
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
        } catch (ReflectionException $e) {
            return redirect()->to(site_url("error"));
        }
        $this->db->transComplete();
        return $this->cargar_vista('pages/vcompra', $data);
    }

    public function getVentas()
    {
        $ventas = $this->modeloVentas->where('estado', 'en espera')->findAll();
        foreach ($ventas as $venta) {
            //unidad
            $unidad = $this->modeloUnidades->where('matricula', $venta->matricula)->first();
            $unidad->modelo = $this->modeloCoches->getModelo($unidad->id_coche);
            $venta->unidad = $unidad;
            //comprador
            $venta->cliente = $this->modeloUsuarios->where('uid', $venta->uid_cliente)->first();
        }
        return $ventas;
    }

    public function tramitar()
    {
        if (! $this->autentificar(1)) return redirect()->to(site_url());
        $data["ventas"] = $this->getVentas();
        return $this->cargar_vista('pages/admin/vvalidarcompra', $data);
    }

    public function aceptar($id)
    {
        $data["ventas"] = $this->getVentas();
        $venta = $this->modeloVentas->where('id_venta', $id)->first();
        $unidad = $this->modeloUnidades->where('matricula', $venta->matricula)->first();
        $vendedor = $this->modeloUsuarios->where('uid', $_SESSION['vendedor']['id'])->first();
        $venta->uid_vendedor = $vendedor->uid;
        $venta->estado = "aceptada";
        $canceladas = $this->modeloVentas->whereNotIn('id_venta', [$id])->findAll();
        $cliente = $this->modeloUsuarios->where('uid', $venta->uid_cliente)->first();

        $this->db->transBegin();
        try {
            $this->modeloVentas->update($id, $venta);

            foreach ($canceladas as $cancelada) {
                $cancelada->estado = "cancelada";
                $this->modeloVentas->update($cancelada->id_venta, $cancelada);
            }
            $vendedor->ventas++;
            $this->modeloUsuarios->update($vendedor->uid, $vendedor);
            $cliente->gastado += $unidad->precio;
            $this->modeloUsuarios->update($cliente->uid, $cliente);
            //Borrar unidad vendida de BD
            //$this->modeloUnidades->where('matricula', $unidad->matricula)->delete();
            $data["aceptar"] = "Venta aceptada exitosamente!";
            $this->mailer->enviarEmail($cliente->email);
        } catch (ReflectionException $e) {
            $this->db->trans_rollback();
            $data["err"] = "Error en la BD al aceptar la venta... " . $e->getMessage();
            return $this->cargar_vista('pages/admin/vvalidarcompra', $data);
        }
        $this->db->transCommit();
        return $this->cargar_vista('pages/admin/vvalidarcompra', $data);
    }

    public function cancelar($id)
    {
        $data["ventas"] = $this->getVentas();
        $venta = $this->modeloVentas->where('id_venta', $id)->first();
        $venta->estado = "cancelada";
        $this->modeloVentas->update($id, $venta);
        $data["cancelar"] = "Venta cancelada correctamente";
        return $this->cargar_vista('pages/admin/vvalidarcompra', $data);
    }

    public function admin() {
        $data['ventas'] = $this->modeloVentas->findAll();
        return $this->cargar_vista('pages/admin/vtablaventas', $data);
    }

    public function delete() {
        $this->modeloVentas->where('estado', 'cancelada')->delete();
        return redirect()->to(site_url('admin/VerVentas'));
    }
}
