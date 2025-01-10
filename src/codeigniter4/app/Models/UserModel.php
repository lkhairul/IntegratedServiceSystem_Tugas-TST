<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; // Pastikan nama tabel benar
    protected $primaryKey = 'user_id'; // Primary key tabel
    protected $allowedFields = ['username', 'email', 'password', 'latitude', 'longitude', 'wishlist', 'reading', 'completed']; // Tambahkan latitude dan longitude
    protected $useTimestamps = false;
}
