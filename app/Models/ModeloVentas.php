<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloVentas extends Model
{
    protected $table            = 'ventas';
    protected $primaryKey       = 'id_venta';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['uid_cliente', 'uid_vendedor', 'matricula', 'fecha_venta', 'estado'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function enVenta($matricula)
    {
        $query = $this->where('matricula', $matricula)->where('estado', 'aceptada')->first();
        $result = $query === null ? true : false;
        return $result;
    }

    public function reservadosPorUsuario($id) {
        $result = $this->distinct()->select('matricula')->where('uid_cliente' , $id)->findAll();
        $matriculas = [];
        foreach($result as $r) {
            $matriculas[] = $r->matricula;
        }
        return $matriculas;
    }
}
