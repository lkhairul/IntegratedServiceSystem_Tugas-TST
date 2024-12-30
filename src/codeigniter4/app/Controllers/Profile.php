<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Profile extends Controller
{
    public function index()
    {
        $data = [];
        $model = new UserModel();
        $data['user'] = $model->find(session()->get('user_id'));

        echo view('profile', $data);
    }

    public function update()
    {
        helper(['form']);
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[20]',
                'password' => 'permit_empty|min_length[8]',
                'password_confirm' => 'matches[password]',
                'latitude' => 'permit_empty|decimal',
                'longitude' => 'permit_empty|decimal'
            ];

            if ($this->validate($rules)) {
                $model = new UserModel();
                $userData = [
                    'user_id' => session()->get('user_id'),
                    'username' => $this->request->getVar('username'),
                    'latitude' => $this->request->getVar('latitude'),
                    'longitude' => $this->request->getVar('longitude'),
                ];

                if ($this->request->getVar('password') != '') {
                    $userData['password'] = $this->request->getVar('password');
                }

                $model->save($userData);
                return redirect()->to('/profile');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        $model = new UserModel();
        $data['user'] = $model->find(session()->get('user_id'));

        echo view('profile', $data);
    }
}