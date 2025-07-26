<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\RegisterModel;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('Auth/register');
    }

   public function process()
{
    $rules = [
        'name'     => 'required|min_length[3]|regex_match[/^[a-zA-Z\s]+$/]',
        'email'    => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
    ];

    $messages = [
        'name' => [
            'required' => 'Nama wajib diisi.',
            'min_length' => 'Nama minimal 3 karakter.',
            'regex_match'  => 'Nama hanya boleh terdiri dari huruf dan spasi.'
        ],
        'email' => [
            'required' => 'Email wajib diisi.',
            'valid_email' => 'Format email tidak valid.',
            'is_unique' => 'Email sudah terdaftar.'
        ],
        'password' => [
            'required' => 'Password wajib diisi.',
            'min_length' => 'Password minimal 6 karakter.'
        ]
    ];

    if (!$this->validate($rules, $messages)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $model = new RegisterModel();
    $model->save([
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
    ]);

    session()->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
    return redirect()->to('/register');
}


}
