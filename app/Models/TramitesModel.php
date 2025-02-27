<?php

namespace App\Models;

use CodeIgniter\Model;

class TramitesModel extends Model
{
    protected $table            = 'tramites';        // Nombre de la tabla en la BD
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'afiliado_id',
        'tramite_id',
        'delegacion_inicia_id',
        'fecha_inicio',
        'observaciones',
        'expediente',
        'usuario_carga'
    ];

    // Si quieres timestamps automáticos (created_at, updated_at) 
    // define tus columnas y habilita lo siguiente:
    // protected $useTimestamps = true;
    // protected $createdField  = 'creado_en';
    // protected $updatedField  = 'actualizado_en';
}
