<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function register()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
                'username' => 'required|min_length[3]|max_length[20]|is_unique[user.username]',
                'password' => 'required|min_length[8]',
                'password_confirm' => 'matches[password]'
            ];

            if ($this->validate($rules)) {
                $model = new UserModel();
                $newData = [
                    'email' => $this->request->getVar('email'),
                    'username' => $this->request->getVar('username'),
                    'password' => $this->request->getVar('password'),
                ];
                $model->save($newData);
                return redirect()->to('/auth/login');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        echo view('register', $data);
    }

    public function login()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email_or_username' => 'required',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email_or_username,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => 'Email/Username or Password don\'t match'
                ]
            ];

            if ($this->validate($rules, $errors)) {
                $model = new UserModel();
                $user = $model->where('email', $this->request->getVar('email_or_username'))
                              ->orWhere('username', $this->request->getVar('email_or_username'))
                              ->first();

                $this->setUserSession($user);
                return redirect()->to('/profile');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        echo view('login', $data);
    }

    private function setUserSession($user)
    {
        $data = [
            'user_id' => $user['user_id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}