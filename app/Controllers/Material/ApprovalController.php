<?php

namespace App\Controllers\Material;

use App\Controllers\BaseController;
use App\Models\Dashboardu\MaterialModel;

class ApprovalController extends BaseController
{
    protected $materialModel;

    public function __construct()
    {
        $this->materialModel = new MaterialModel();
    }

    public function index()
    {
        $materi = $this->materialModel->orderBy('created_at', 'DESC')->findAll();
        return view('Material/Approval', ['materi' => $materi]);
    }

    public function approve($id)
    {
        $materi = $this->materialModel->find($id);
        if (!$materi) return redirect()->back()->with('error', 'Materi tidak ditemukan.');

        if ($materi['is_approved'] == 2)
            return redirect()->back()->with('error', 'Materi sudah ditutup.');
        if ($materi['is_approved'] == 1)
            return redirect()->back()->with('error', 'Materi sudah disetujui.');

        $this->materialModel->update($id, [
            'is_approved' => 1,
            'approved_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Materi disetujui.');
    }

    public function reject($id)
    {
        $materi = $this->materialModel->find($id);
        if (!$materi) return redirect()->back()->with('error', 'Materi tidak ditemukan.');

        if ($materi['is_approved'] == 2)
            return redirect()->back()->with('error', 'Materi sudah ditutup.');
        if ($materi['is_approved'] == 1)
            return redirect()->back()->with('error', 'Materi sudah disetujui.');

        $this->materialModel->update($id, [
            'is_approved' => -1,
            'approved_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Materi ditolak.');
    }

    public function close($id)
    {
        $materi = $this->materialModel->find($id);
        if (!$materi) return redirect()->back()->with('error', 'Materi tidak ditemukan.');

        if ($materi['is_approved'] == 2)
            return redirect()->back()->with('error', 'Materi sudah ditutup.');

        $this->materialModel->update($id, [
            'is_approved' => 2,
            'approved_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Materi ditutup.');
    }
}
