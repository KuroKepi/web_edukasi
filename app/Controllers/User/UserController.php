<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $users = $this->userModel->findAll();
        return view('User/ListUser', ['users' => $users]);
    }

    public function create()
    {
        return view('User/CreateUser');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]|regex_match[/^[a-zA-Z\s]+$/]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role' => 'required|in_list[admin,user]'
        ];

        $messages = [
            'name' => [
                'required' => 'Nama wajib diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
                'regex_match' => 'Nama hanya boleh huruf dan spasi.'
            ],
            'email' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique' => 'Email sudah terdaftar.'
            ],
            'password' => [
                'required' => 'Password wajib diisi.',
                'min_length' => 'Password minimal 6 karakter.'
            ],
            'role' => [
                'required' => 'Role wajib dipilih.',
                'in_list' => 'Role hanya boleh admin atau user.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role')
        ]);

        return redirect()->to('/user')->with('success', 'User berhasil dibuat.');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'User tidak ditemukan.');
        }

        return view('User/EditUser', ['user' => $user]);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'User tidak ditemukan.');
        }

        $emailRule = ($user['email'] === $this->request->getPost('email'))
            ? 'required|valid_email'
            : 'required|valid_email|is_unique[users.email]';

        $rules = [
            'name' => 'required|min_length[3]|regex_match[/^[a-zA-Z\s]+$/]',
            'email' => $emailRule,
            'role' => 'required|in_list[admin,user]',
        ];

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        $messages = [
            'name' => [
                'required' => 'Nama wajib diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
                'regex_match' => 'Nama hanya boleh huruf dan spasi.'
            ],
            'email' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique' => 'Email sudah digunakan.'
            ],
            'password' => [
                'min_length' => 'Password minimal 6 karakter.'
            ],
            'role' => [
                'required' => 'Role wajib dipilih.',
                'in_list' => 'Role hanya boleh admin atau user.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id' => $id,
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role')
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->save($data);

        return redirect()->to('/user')->with('success', 'User berhasil diperbarui.');
    }
    public function show($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'User tidak ditemukan.');
        }

        return view('User/DetailUser', ['user' => $user]);
    }

}
