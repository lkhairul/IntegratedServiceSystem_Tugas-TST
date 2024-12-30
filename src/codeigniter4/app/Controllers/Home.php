<?php

namespace App\Controllers;

use App\Models\BookModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        $model = new BookModel();
        $data['books'] = $model->findAll();

        echo view('home', $data);
    }
}
