<?php

namespace App\Models;

use CodeIgniter\Model;

class AfiliadosModel extends Model
{
    protected $table            = 'afiliados';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nombre',
        'apellido',
        'dni',
        'fecha_nacimiento',
        'numero_afiliado',
        'delegacion_id',
    ];

    // Opcionalmente, si quieres timestamps automáticos, descomenta:
    // protected $useTimestamps = true;
    // protected $createdField  = 'creado_en';
    // protected $updatedField  = 'actualizado_en';
}
