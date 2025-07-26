<?php

namespace App\Controllers\Comment;

use App\Controllers\BaseController;
use App\Models\Comment\CommentModel;
use App\Models\Dashboardu\MaterialModel;

class CommentController extends BaseController
{
    protected $commentModel;
    protected $materialModel;

    public function __construct()
    {
        $this->commentModel = new CommentModel();
        $this->materialModel = new MaterialModel();
    }

    public function store($materialId)
    {
        $userId = session('user_id');
        $content = $this->request->getPost('content');

        if (!$content) {
            return redirect()->back()->with('error', 'Komentar tidak boleh kosong.');
        }

        $this->commentModel->insert([
            'user_id'     => $userId,
            'material_id' => $materialId,
            'content'     => $content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
