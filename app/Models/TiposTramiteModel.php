<?php

namespace App\Models;

use CodeIgniter\Model;

class TiposTramiteModel extends Model
{
    protected $table            = 'tipos_tramite';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['descripcion'];

    // Timestamps opcionales
    // protected $useTimestamps = true;
}
