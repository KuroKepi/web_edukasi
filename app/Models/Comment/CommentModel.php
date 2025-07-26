<?php

namespace App\Models\Comment;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';

    protected $allowedFields = [
        'user_id',
        'material_id',
        'parent_id',
        'content',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;

    public function getCommentsByMaterial($materialId)
    {
        return $this->select('comments.*, users.name as user_name')
            ->join('users', 'users.id = comments.user_id')
            ->where('material_id', $materialId)
            ->orderBy('comments.created_at', 'DESC')
            ->findAll();
    }
}
