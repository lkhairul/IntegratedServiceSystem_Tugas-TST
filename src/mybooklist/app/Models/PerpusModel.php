<?php

namespace App\Models;

use CodeIgniter\Model;

class PerpusModel extends Model
{
    protected $table = 'perpus';
    protected $primaryKey = 'perpus_id';
    protected $allowedFields = ['name', 'latitude', 'longitude'];
}