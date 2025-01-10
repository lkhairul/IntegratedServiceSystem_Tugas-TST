<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        $model = new BookModel();
        $data['books'] = $model->findAll();

        $session = session();
        $recommendedBooks = [];

        if ($session->get('isLoggedIn')) {
            $userId = $session->get('user_id');
            $userModel = new UserModel();
            $thisUser = $userModel->find($userId);

            if ($thisUser && !empty($thisUser['completed'])) {
                $completedIds = json_decode($thisUser['completed'], true); 

                // Count genres from completed books
                $genreCounts = [];
                foreach ($completedIds as $bid) {
                    $completedBook = $model->find($bid);
                    if ($completedBook && !empty($completedBook['genres'])) {
                        $genresArray = explode(',', $completedBook['genres']);
                        foreach ($genresArray as $g) {
                            $g = trim($g);
                            if (!empty($g)) {
                                $genreCounts[$g] = ($genreCounts[$g] ?? 0) + 1;
                            }
                        }
                    }
                }

                // Sort genres in descending order
                arsort($genreCounts);
                // Take the top 3 genres
                $topGenres = array_slice(array_keys($genreCounts), 0, 3);

                // fetch recommended books that have at least one of the top 3 genres
                $allBooks = $model->findAll();
                foreach ($allBooks as $bk) {
                    if (!empty($bk['genres'])) {
                        $bkGenres = array_map('trim', explode(',', $bk['genres']));
                        if (array_intersect($topGenres, $bkGenres)) {
                            $recommendedBooks[] = $bk;
                        }
                    }
                }
            }
        }

        $data['recommendedBooks'] = $recommendedBooks;

        echo view('home', $data);
    }
}
