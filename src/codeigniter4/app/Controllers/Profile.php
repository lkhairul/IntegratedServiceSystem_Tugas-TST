<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Profile extends Controller
{
    public function index()
    {
        $session = session();
        $userModel = new UserModel();
        $data['user'] = $userModel->find($session->get('user_id'));

        return view('profile', $data);
    }

    public function update()
    {
        helper(['form', 'url']);

        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required',
            'password' => 'permit_empty|min_length[6]',
            'password_confirm' => 'matches[password]',
            'latitude' => 'required|decimal|greater_than_equal_to[-90]|less_than_equal_to[90]',
            'longitude' => 'required|decimal|greater_than_equal_to[-180]|less_than_equal_to[180]'
        ]);

        if ($validation->withRequest($this->request)->run() == false) {
            $session = session();
            $userModel = new UserModel();
            $data['user'] = $userModel->find($session->get('user_id'));
            $data['validation'] = $validation;

            return view('profile', $data);
        } else {
            $session = session();
            $userModel = new UserModel();

            $latitude = $this->request->getPost('latitude') !== '' ? $this->request->getPost('latitude') : null;
            $longitude = $this->request->getPost('longitude') !== '' ? $this->request->getPost('longitude') : null;

            $userData = [
                'username' => $this->request->getPost('username'),
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];

            // Jika password diisi, tambahkan ke data update
            if ($this->request->getPost('password')) {
                $userData['password'] = md5($this->request->getPost('password'));
            }

            // Update data di database
            $userModel->update($session->get('user_id'), $userData);

            // Perbarui data sesi jika username berubah
            $session->set('username', $userData['username']);

            return redirect()->to('/profile');
        }
    }
}
