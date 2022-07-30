<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{

    public function loginPage()
    {

        $data['title'] = "Login";
        echo view('templates/header', $data);
        echo view('auth/login');
        echo view('templates/footer');
    }

    public function registerPage()
    {

        $data['title'] = "Register";
        echo view('templates/header', $data);
        echo view('auth/register');
        echo view('templates/footer');
    }

    public function register()
    {
        $rules = [
            'firstName' => 'required|min_length[2]|max_length[50]',
            'lastName' => 'required|min_length[2]|max_length[50]',
            'email' => 'required|min_length[4]|max_length[50]|valid_email',
            'password' => 'required|min_length[4]|max_length[50]',
            'phoneNumber' => 'required|min_length[2]|max_length[50]',
            'username' => 'required|min_length[2]|max_length[50]|is_unique[user.username]',
        ];

        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $data = [
                'firstName' => $this->request->getVar('firstName'),
                'lastName' => $this->request->getVar('lastName'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'phoneNumber' => $this->request->getVar('phoneNumber'),
                'username' => $this->request->getVar('username'),
                'role' => 'user',
            ];
            $userModel->save($data);
            return "ok";
        } else {
            $data['validation'] = $this->validator;
            return $data['validation']->listErrors();
        }
    }


    public function login()
    {
        $rules = [
            'password' => 'required',
            'username' => 'required',
        ];

        if ($this->validate($rules)) {

            $session = session();
            $userModel = new UserModel();

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $data = $userModel->where('username', $username)->first();

            if ($data) {
                $pass = $data['password'];
                $authenticatePassword = password_verify($password, $pass);
                if ($authenticatePassword) {
                    $ses_data = [
                        'id' => $data['id'],
                        'username' => $data['username'],
                        'firstName' => $data['firstName'],
                        'lastName' => $data['lastName'],
                        'email' => $data['email'],
                        'phoneNumber' => $data['phoneNumber'],
                        'role' => $data['role'],
                        'isLoggedIn' => TRUE,
                    ];
                    $session->set($ses_data);
                    return "ok";
                } else {
                    $session->setFlashdata('msg', 'Password is incorrect.');
                    return "Password is incorrect.";
                }
            } else {
                $session->setFlashdata('msg', 'Username is incorrect.');
                return "Username is incorrect.";
            }
        } else {
            $data['validation'] = $this->validator;
            return $data['validation']->listErrors();
        }
    }

    public function logout()
    {
        $ses_data = [
            'id' => '',
            'name' => '',
            'surname' => '',
            'email' => '',
            'phoneNumber' => '',
            'username' => '',
            'isLoggedIn' => FALSE,
            'role' => '',
        ];
        session()->set($ses_data);
        echo 'Successfully Logout';
    }
}