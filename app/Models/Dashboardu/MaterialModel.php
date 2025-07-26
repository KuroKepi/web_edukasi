<?php

namespace App\Models\Dashboardu;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table = 'materials';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'user_id',
        'title',
        'description',
        'type',
        'file_path',
        'thumbnail',
        'is_approved',
        'approved_at',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function upload($request)
    {
        $file = $request->getFile('file');
        $thumbnail = $request->getFile('thumbnail');

        $title = $request->getPost('title');
        $description = $request->getPost('description');
        $type = $request->getPost('type');

        if (empty($type)) {
            return ['error' => 'Jenis materi wajib dipilih.'];
        }

        if ((!$file || !$file->isValid()) && trim($description) === '') {
            return ['error' => 'Isi deskripsi atau upload file materi.'];
        }

        $fileName = null;
        $thumbName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($file->getSize() > 10 * 1024 * 1024) {
                return ['error' => 'File terlalu besar! Maksimal 10MB.'];
            }

            $allowedTypes = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'text/plain',
                'application/zip',
                'application/x-rar-compressed',
                'video/mp4',
                'video/webm',
                'video/x-matroska',
                'audio/mpeg',
                'audio/wav',
                'audio/ogg'
            ];

            if (!in_array($file->getClientMimeType(), $allowedTypes)) {
                return ['error' => 'Tipe file tidak diizinkan.'];
            }

            $fileName = $file->getRandomName();
            $file->move('uploads/materials', $fileName);
            $fileName = 'uploads/materials/' . $fileName;
        }

        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            if ($thumbnail->getSize() > 10 * 1024 * 1024) {
                return ['error' => 'Thumbnail terlalu besar! Maksimal 10MB.'];
            }

            $allowedThumbTypes = [
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/webp',
                'image/bmp',
                'image/svg+xml'
            ];

            if (!in_array($thumbnail->getClientMimeType(), $allowedThumbTypes)) {
                return ['error' => 'Thumbnail harus berupa gambar yang valid.'];
            }

            $thumbName = $thumbnail->getRandomName();
            $thumbnail->move('uploads/thumbnails', $thumbName);
            $thumbName = 'uploads/thumbnails/' . $thumbName;
        }

        try {
            $this->save([
                'user_id' => session('user_id'),
                'title' => $title,
                'description' => $description,
                'file_path' => $fileName,
                'thumbnail' => $thumbName,
                'type' => $type,
                'is_approved' => 0
            ]);
        } catch (\Exception $e) {
            return ['error' => 'Gagal menyimpan materi: ' . $e->getMessage()];
        }

        return ['success' => true];
    }

    public function updateMateri($id, $request)
    {
        $data = $this->find($id);
        if (!$data || $data['user_id'] != session('user_id')) {
            return ['error' => 'Data tidak ditemukan.'];
        }

        $title = $request->getPost('title');
        $description = $request->getPost('description');
        $type = $request->getPost('type');
        $file = $request->getFile('file');
        $thumbnail = $request->getFile('thumbnail');

        $filePath = $data['file_path'];
        $thumbPath = $data['thumbnail'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newFile = $file->getRandomName();
            $file->move('uploads/materials', $newFile);
            if ($filePath && file_exists($filePath))
                unlink($filePath);
            $filePath = 'uploads/materials/' . $newFile;
        }

        if ($thumbnail && $thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $newThumb = $thumbnail->getRandomName();
            $thumbnail->move('uploads/thumbnails', $newThumb);
            if ($thumbPath && file_exists($thumbPath))
                unlink($thumbPath);
            $thumbPath = 'uploads/thumbnails/' . $newThumb;
        }

        return $this->save([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'file_path' => $filePath,
            'thumbnail' => $thumbPath,
            'is_approved' => 0
        ]) ? ['success' => true] : ['error' => 'Gagal update.'];
    }

    public function getApproved()
    {
        return $this->where('is_approved', 1)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getPending()
    {
        return $this->where('is_approved', 0)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getByUser($user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->findAll();
    }

    public function getById($id)
    {
        return $this->find($id);
    }
}
