<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'userID';
    protected $allowedFields = ['name', 'email', 'password', 'userLatitude', 'userLongitude'];
}
?>
