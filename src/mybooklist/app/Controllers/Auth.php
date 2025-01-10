<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function register()
    {
        helper(['form', 'url']);

        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ]);

        if ($validation->withRequest($this->request)->run() == false) {
            return view('register', ['validation' => $validation]);
        } else {
            $userModel = new UserModel();
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => md5($this->request->getPost('password'))
            ];

            $userModel->save($data);

            // Set user session
            $user = $userModel->where('email', $this->request->getPost('email'))->first();
            $this->setUserSession($user);

            // Redirect 
            return redirect()->to('/profile');
        }
    }

    public function login()
    {
        helper(['form', 'url']);
        $model = new UserModel();
    
        $emailOrUsername = $this->request->getPost('email_or_username');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $emailOrUsername)
                      ->orWhere('username', $emailOrUsername)
                      ->first();
    
        // Validasi pengguna dan password
        if ($user && md5($password) === $user['password']) {
            $this->setUserSession($user);
            return redirect()->to('/profile'); 
        } else {
            return view('login', [
                'error' => 'Email/Username atau Password salah.'
            ]);
        }
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
