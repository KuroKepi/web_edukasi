<?php

namespace App\Controllers\Material;

use App\Controllers\BaseController;
use App\Models\Dashboardu\MaterialModel;

class MaterialController extends BaseController
{
    public function index()
    {
        $model = new MaterialModel();
        $userId = session('user_id');

        $data['materi'] = $model->getByUser($userId);

        return view('Material/Material', $data);
    }


    public function upload()
    {
        return view('Material/Upload');
    }

    public function save()
    {
        $model = new \App\Models\Dashboardu\MaterialModel();
        $result = $model->upload($this->request);

        if (isset($result['error'])) {
            return redirect()->back()->withInput()->with('error', $result['error']);
        }

        return redirect()->to('/materi')->with('success', 'Materi berhasil diupload dan menunggu approval.');
    }

    public function detail($id)
    {
        $model = new \App\Models\Dashboardu\MaterialModel();
        $materi = $model->getById($id);

        if (!$materi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Materi tidak ditemukan.");
        }

        return view('Material/Detail', ['materi' => $materi]);
    }

    public function delete($id)
    {
        $model = new MaterialModel();
        $materi = $model->find($id);

        if (!$materi) {
            return redirect()->back()->with('error', 'Materi tidak ditemukan.');
        }

        if ($materi['file_path'] && file_exists($materi['file_path'])) {
            unlink($materi['file_path']);
        }

        if ($materi['thumbnail'] && file_exists($materi['thumbnail'])) {
            unlink($materi['thumbnail']);
        }

        $model->delete($id);

        return redirect()->to(base_url('materi'))->with('success', 'Materi berhasil dihapus.');
    }

    public function edit($id)
    {
        $model = new MaterialModel();
        $materi = $model->getById($id);

        if (!$materi || $materi['user_id'] != session('user_id')) {
            return redirect()->to('/materi')->with('error', 'Data tidak ditemukan atau tidak berhak mengedit.');
        }

        return view('Material/Edit', ['materi' => $materi]);
    }

    public function update($id)
    {
        $model = new \App\Models\Dashboardu\MaterialModel();
        $materi = $model->find($id);

        if (!$materi) {
            return redirect()->to('/materi')->with('error', 'Materi tidak ditemukan.');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'type' => 'required|in_list[artikel,ebook,image,audio,video]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $file = $this->request->getFile('file');
        $thumbnail = $this->request->getFile('thumbnail');

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'type' => $this->request->getPost('type'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (file_exists($materi['file_path'])) {
                unlink($materi['file_path']);
            }
            $newFileName = $file->getRandomName();
            $file->move('uploads/materials', $newFileName);
            $data['file_path'] = 'uploads/materials/' . $newFileName;
        } else {
            $data['file_path'] = $materi['file_path'];
        }

        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            if (file_exists($materi['thumbnail'])) {
                unlink($materi['thumbnail']);
            }
            $newThumbName = $thumbnail->getRandomName();
            $thumbnail->move('uploads/thumbnails', $newThumbName);
            $data['thumbnail'] = 'uploads/thumbnails/' . $newThumbName;
        } else {
            $data['thumbnail'] = $materi['thumbnail'];
        }

        $model->update($id, $data);

        return redirect()->to('/materi')->with('success', 'Materi berhasil diperbarui.');
    }



}
