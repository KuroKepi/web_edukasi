<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('Auth/login');
    }

    public function process()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        if (!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Email atau password salah!');
        }

        session()->set([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedIn' => true
        ]);

        return redirect()->to('/user/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }
}
