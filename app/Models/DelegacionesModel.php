<?php

namespace App\Models;

use CodeIgniter\Model;

class DelegacionesModel extends Model
{
    protected $table            = 'delegaciones';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nombre'];

    // Igual, si quieres timestamps:
    // protected $useTimestamps = true;
}
