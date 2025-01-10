<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; 
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'email', 'password', 'latitude', 'longitude', 'wishlist', 'reading', 'completed']; // Tambahkan latitude dan longitude
    protected $useTimestamps = false;
}
