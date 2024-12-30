<?php

namespace App\Models;

use CodeIgniter\Model;

class UserBookModel extends Model
{
    protected $table = 'user_books';
    protected $allowedFields = ['bookID', 'userID', 'status'];
}
?>
