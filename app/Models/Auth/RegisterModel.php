<?php

namespace App\Models\Auth;

use CodeIgniter\Model;

class RegisterModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password'];
    protected $useTimestamps = true;
}
