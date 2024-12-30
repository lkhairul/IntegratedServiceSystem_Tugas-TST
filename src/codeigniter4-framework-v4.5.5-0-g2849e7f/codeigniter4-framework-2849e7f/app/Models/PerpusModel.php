<?php

namespace App\Models;

use CodeIgniter\Model;

class PerpusModel extends Model
{
    protected $table = 'perpus';
    protected $primaryKey = 'perpus';
    protected $allowedFields = ['libraryName', 'latitude', 'longitude'];
}
?>
