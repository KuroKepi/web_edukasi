<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\Dashboardu\MaterialModel;
use App\Models\Comment\CommentModel;

class DashboardUser extends BaseController
{
    protected $materialModel;

    public function __construct()
    {
        $this->materialModel = new MaterialModel();
    }

    public function index()
    {
        $materi = $this->materialModel
            ->whereIn('is_approved', [1, 2]) // tampilkan yang disetujui dan tertutup
            ->orderBy('approved_at', 'DESC')
            ->findAll();

        return view('User/DashboardUser', ['materi' => $materi]);
    }

    public function detail($id)
    {
        $materi = $this->materialModel
            ->where('id', $id)
            ->whereIn('is_approved', [1, 2])
            ->first();

        if (!$materi) {
            return redirect()->to('user/dashboard')->with('error', 'Materi tidak ditemukan.');
        }

        $commentModel = new CommentModel();
        $komentar = $commentModel
            ->select('comments.*, users.name as username')
            ->join('users', 'users.id = comments.user_id')
            ->where('material_id', $id)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return view('User/DetailMaterial', [
            'materi' => $materi,
            'komentar' => $komentar
        ]);
    }

    public function submitKomentar()
    {
        $userId = session('user_id');
        $materialId = $this->request->getPost('material_id');
        $content = $this->request->getPost('content');
        $parentId = $this->request->getPost('parent_id');

        if (empty($content)) {
            return redirect()->back()->with('error', 'Komentar tidak boleh kosong.');
        }

        $materi = $this->materialModel->where('id', $materialId)->first();

        if (!$materi || $materi['is_approved'] != 1) {
            return redirect()->back()->with('error', 'Komentar tidak dapat ditambahkan pada materi ini.');
        }

        $commentModel = new CommentModel();
        $commentModel->save([
            'user_id' => $userId,
            'material_id' => $materialId,
            'parent_id' => $parentId ?: null,
            'content' => $content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil dikirim.');
    }
}
