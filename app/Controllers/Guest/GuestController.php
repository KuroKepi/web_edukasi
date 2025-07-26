<?php

namespace App\Controllers\Guest;
use App\Controllers\BaseController;
use App\Models\Dashboardu\MaterialModel;

class GuestController extends BaseController
{
    public function index()
    {
        $materiModel = new MaterialModel();
        $materi = $materiModel
                    ->where('is_approved', 1)
                    ->findAll();

        return view('guest/welcome', ['materi' => $materi]);
    }

    public function about()
    {
        return view('guest/about');
    }
}
