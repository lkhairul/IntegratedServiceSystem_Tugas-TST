<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Profile extends BaseController
{
    public function index()
    {
        $session = session();
        $userModel = new UserModel();
        $data['user'] = $userModel->find($session->get('user_id'));

        return view('profile', $data);
    }

    public function updateUsername()
    {
        helper(['form', 'url']);
        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required'
        ]);

        if ($validation->withRequest($this->request)->run() == false) {
            return redirect()->back()->withInput()->with('validation', $validation);
        } else {
            $session = session();
            $userModel = new UserModel();
            $userModel->update($session->get('user_id'), [
                'username' => $this->request->getPost('username')
            ]);

            return redirect()->back()->with('success', 'Username updated successfully');
        }
    }

    public function updatePassword()
    {
        helper(['form', 'url']);
        $validation = \Config\Services::validation();

        $validation->setRules([
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]'
        ]);

        if ($validation->withRequest($this->request)->run() == false) {
            return redirect()->back()->withInput()->with('validation', $validation);
        } else {
            $session = session();
            $userModel = new UserModel();
            $hashedPassword = md5($this->request->getPost('password'));
            $userModel->update($session->get('user_id'), [
                'password' => $hashedPassword
            ]);

            return redirect()->back()->with('success', 'Password updated successfully');
        }
    }

    public function updateLocation()
    {
        helper(['form', 'url']);
        $validation = \Config\Services::validation();

        $validation->setRules([
            'latitude' => 'required|decimal|greater_than_equal_to[-90]|less_than_equal_to[90]',
            'longitude' => 'required|decimal|greater_than_equal_to[-180]|less_than_equal_to[180]'
        ]);

        if ($validation->withRequest($this->request)->run() == false) {
            return redirect()->back()->withInput()->with('validation', $validation);
        } else {
            $session = session();
            $userModel = new UserModel();
            $userModel->update($session->get('user_id'), [
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude')
            ]);

            return redirect()->back()->with('success', 'Location updated successfully');
        }
    }
}
