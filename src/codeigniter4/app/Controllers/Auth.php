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

            // Redirect to the profile page after successful registration
            return redirect()->to('/profile');
        }
    }

    public function login()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email_or_username' => 'required',
                'password' => 'required|min_length[6]|validateUser[email_or_username,password]',
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
