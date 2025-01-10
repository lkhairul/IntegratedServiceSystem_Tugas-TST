<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Book extends Controller
{
    public function catalog()
    {
        $model = new BookModel();
        $q = $this->request->getGet('q');
        $genre = $this->request->getGet('genre');

        if ($q) {
            $model->like('title', $q);
        }

        if ($genre) {
            $model->like('genres', $genre);
        }

        $data['books'] = $model->findAll();
        $data['q'] = $q;
        $data['genre'] = $genre;

        return view('book_catalog', $data);
    }

    public function view($id)
    {
        $session = session();
        $userId = $session->get('user_id');

        $bookModel = new BookModel();
        $book = $bookModel->find($id);
        
        if (!$book) {
            return redirect()->to('/')->with('error', 'Book not found');
        }

        $user = null;
        if ($userId) {
            $userModel = new UserModel();
            $user = $userModel->find($userId);
        }

        return view('book_details', [
            'book' => $book,
            'user' => $user
        ]);
    }

    public function management()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $bookModel = new BookModel();
        $user = $userModel->find($userId);

        $wishlistBooks = [];
        $readingBooks = [];
        $completedBooks = [];

        if ($user) {
            if (!empty($user['wishlist'])) {
                $wishlistIds = json_decode($user['wishlist'], true);
                $wishlistBooks = $bookModel->whereIn('book_id', $wishlistIds)->findAll();
            }

            if (!empty($user['reading'])) {
                $readingIds = json_decode($user['reading'], true);
                $readingBooks = $bookModel->whereIn('book_id', $readingIds)->findAll();
            }

            if (!empty($user['completed'])) {
                $completedIds = json_decode($user['completed'], true);
                $completedBooks = $bookModel->whereIn('book_id', $completedIds)->findAll();
            }
        }

        return view('book_management', [
            'wishlistBooks' => $wishlistBooks,
            'readingBooks' => $readingBooks,
            'completedBooks' => $completedBooks
        ]);
    }

    public function borrow($bookId)
    {
        // Pastikan user sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        // Ambil data JSON lama
        $borrowedList = [];
        if (!empty($user['borrowed'])) {
            $borrowedList = json_decode($user['borrowed'], true);
        }

        // Tambahkan jika belum ada
        if (!in_array($bookId, $borrowedList)) {
            $borrowedList[] = $bookId;
            $userModel->update($userId, [
                'borrowed' => json_encode($borrowedList)
            ]);
        }

        return redirect()->back()->with('success', 'Book borrowed successfully');
    }

    // Menambahkan book_id ke kolom wishlist jika belum ada di manapun
    public function addWishlist($bookId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $wishlist  = !empty($user['wishlist'])  ? json_decode($user['wishlist'], true)   : [];
        $reading   = !empty($user['reading'])   ? json_decode($user['reading'], true)    : [];
        $completed = !empty($user['completed']) ? json_decode($user['completed'], true)  : [];

        // Hanya tambahkan jika bookId belum ada di ketiga array
        if (!in_array($bookId, $wishlist) && !in_array($bookId, $reading) && !in_array($bookId, $completed)) {
            $wishlist[] = $bookId;
            $userModel->update($userId, ['wishlist' => json_encode($wishlist)]);
        }

        return redirect()->back()->with('success', 'Added to Wishlist');
    }

    // Memindahkan book_id dari wishlist ke reading
    public function startReading($bookId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $wishlist  = !empty($user['wishlist'])  ? json_decode($user['wishlist'], true)   : [];
        $reading   = !empty($user['reading'])   ? json_decode($user['reading'], true)    : [];
        $completed = !empty($user['completed']) ? json_decode($user['completed'], true)  : [];

        // Jika bookId ada di wishlist, pindahkan ke reading
        if (in_array($bookId, $wishlist) && !in_array($bookId, $reading) && !in_array($bookId, $completed)) {
            // Hapus dari wishlist
            $wishlist = array_diff($wishlist, [$bookId]);
            // Tambah ke reading
            $reading[] = $bookId;

            $userModel->update($userId, [
                'wishlist' => json_encode(array_values($wishlist)),
                'reading'  => json_encode($reading)
            ]);
        }

        return redirect()->back()->with('success', 'Moved to Reading');
    }

    public function completeBook($bookId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $reading   = !empty($user['reading'])   ? json_decode($user['reading'], true)    : [];
        $completed = !empty($user['completed']) ? json_decode($user['completed'], true)  : [];

        // Pindahkan dari reading ke completed jika belum ada
        if (in_array($bookId, $reading) && !in_array($bookId, $completed)) {
            $reading   = array_diff($reading, [$bookId]);
            $completed[] = $bookId;

            $userModel->update($userId, [
                'reading'   => json_encode(array_values($reading)),
                'completed' => json_encode($completed)
            ]);
        }

        return redirect()->back()->with('success', 'Moved to Completed');
    }
}