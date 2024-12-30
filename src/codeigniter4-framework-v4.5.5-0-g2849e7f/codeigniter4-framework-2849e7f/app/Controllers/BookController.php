<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\PerpusModel;
use App\Models\UserBookModel;

class BookController extends BaseController
{
    public function index()
    {
        $bookModel = new BookModel();
        $books = $bookModel->orderBy('title', 'ASC')->findAll();
        return view('index', ['books' => $books]); // Menggunakan view 'index' di root Views
    }

    public function search()
    {
        $bookModel = new BookModel();
        $search = $this->request->getPost('search');
        $books = $bookModel->like('title', $search)->findAll();
        return view('index', ['books' => $books]); // Menggunakan view 'index' di root Views
    }

    public function filter()
    {
        $bookModel = new BookModel();
        $genres = $this->request->getPost('genres');
        $books = $bookModel->like('genres', $genres)->findAll();
        return view('index', ['books' => $books]); // Menggunakan view 'index' di root Views
    }

    public function sort()
    {
        $userLatitude = $this->request->getPost('userLatitude');
        $userLongitude = $this->request->getPost('userLongitude');

        // Anda perlu menghitung jarak dan mengurutkan buku sesuai dengan itu
        // Ini adalah versi yang disederhanakan dan mungkin memerlukan penyesuaian lebih lanjut

        $perpusModel = new PerpusModel();
        $perpuses = $perpusModel->findAll();

        // Menghitung jarak dan mengurutkan buku
        // ....

        return view('index', ['books' => $books]); // Menggunakan view 'index' di root Views
    }

    public function updateStatus()
    {
        $userBookModel = new UserBookModel();
        $data = [
            'bookID' => $this->request->getPost('bookID'),
            'userID' => $this->request->getPost('userID'),
            'status' => $this->request->getPost('status')
        ];
        $userBookModel->save($data);
        return redirect()->to('/');
    }

    public function history($status = null)
    {
        $userBookModel = new UserBookModel();
        
        if ($status) {
            $books = $userBookModel->where('status', $status)->findAll();
        } else {
            // Logika untuk menampilkan semua buku atau halaman default
            $books = $userBookModel->findAll();
        }

        return view('history', ['books' => $books]);
    }
}

?>
