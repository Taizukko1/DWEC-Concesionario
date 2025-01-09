<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloUsuarios extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'uid';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'ap1', 'ap2', 'telefono', 'email', 'pass', 'tipo', 'dni', 'gastado', 'ventas'];

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

    function getTipo($id)
    {
        return $this->where('uid', $id)->findColumn('tipo')[0];
    }

    function getVentas($uid)
    {
        return $this->where('uid', $uid)->findColumn('ventas')[0];
    }

    function getGasto($uid)
    {
        return $this->where('uid', $uid)->findColumn('gastado')[0];
    }
}
