<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Materi Edukasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <style>
    table.dataTable {
      border-collapse: collapse !important;
      margin-left: 0 !important;
      margin-right: auto !important;
      width: 100%;
      background-color: #ffffff;
      border: 1px solid #e5e7eb;
    }

    table.dataTable thead th {
      font-size: 16px;
      padding: 14px 16px;
      border: 1px solid #e5e7eb;
      text-align: left;
      background-color: #f3f4f6;
      color: #111827;
    }

    table.dataTable tbody td {
      font-size: 15px;
      padding: 12px 16px;
      border: 1px solid #e5e7eb;
      text-align: left;
      background-color: #fff;
      color: #374151;
    }

    table.dataTable tbody tr:nth-child(even) td {
      background-color: #f9fafb;
    }

    table.dataTable tbody tr:hover td {
      background-color: #eef2f7;
    }

    .dataTables_wrapper {
      margin-top: 1.5rem;
      padding-left: 1rem;
      font-family: 'Segoe UI', sans-serif;
      color: #374151;
    }

    .dataTables_paginate .paginate_button {
      padding: 6px 12px;
      margin: 0 2px;
      border-radius: 6px;
      border: 1px solid #d1d5db;
      background-color: #f9fafb;
      color: #111827 !important;
      cursor: pointer;
    }

    .dataTables_paginate .paginate_button.current {
      background-color: #3b82f6;
      color: white !important;
      border-color: #3b82f6;
    }

    .dataTables_filter input,
    .dataTables_length select {
      padding: 6px 10px;
      border-radius: 6px;
      border: 1px solid #d1d5db;
      background-color: #ffffff;
    }
  </style>
</head>

<body class="bg-gray-100 font-sans">
  <div class="flex min-h-screen">
    <?= view('Bar/Sidebar') ?>
    <main class="flex-1 bg-gray-50">
      <?= view('Bar/Topbar') ?>

      <div class="p-6 max-w-7xl mx-auto">
        <?php if (session()->getFlashdata('success')): ?>
          <div id="flash-message" class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
          </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
          <div id="flash-message" class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
          </div>
        <?php endif; ?>

        <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
          <table id="materiTable" class="w-full table-auto text-left text-sm text-gray-800">
            <thead class="bg-gray-100 text-xs text-gray-600 uppercase">
              <tr>
                <th class="px-4 py-3">Judul</th>
                <th class="px-4 py-3">Jenis</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Tanggal Persetujuan</th>
                <th class="px-4 py-3 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($materi as $m): ?>
                <tr class="border-b hover:bg-gray-50">
                  <td class="px-4 py-3 font-medium"><?= esc($m['title']) ?></td>
                  <td class="px-4 py-3 capitalize"><?= esc($m['type']) ?></td>
                  <td class="px-4 py-3">
                    <?php if ($m['is_approved'] == 1): ?>
                      <span class="px-2 py-1 text-xs text-white bg-green-600 rounded">Disetujui</span>
                    <?php elseif ($m['is_approved'] == -1): ?>
                      <span class="px-2 py-1 text-xs text-white bg-yellow-500 rounded">Ditolak</span>
                    <?php elseif ($m['is_approved'] == 2): ?>
                      <span class="px-2 py-1 text-xs text-white bg-gray-700 rounded">Tertutup</span>
                    <?php else: ?>
                      <span class="px-2 py-1 text-xs text-white bg-blue-600 rounded">Menunggu</span>
                    <?php endif; ?>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    <?php if ($m['approved_at']): ?>
                      <?= date('d M Y H:i', strtotime($m['approved_at'])) ?>
                    <?php else: ?>
                      <span class="text-gray-400 italic">-</span>
                    <?php endif; ?>
                  </td>
                  <td class="px-4 py-3 text-right">
                    <a href="<?= base_url('materi/detail/' . $m['id']) ?>"
                      class="text-blue-600 hover:underline mr-3">Detail</a>
                    <a href="<?= base_url('materi/edit/' . $m['id']) ?>"
                      class="text-yellow-600 hover:underline mr-3">Edit</a>
                    <button onclick="confirmDelete(<?= $m['id'] ?>)" class="text-red-600 hover:underline">Hapus</button>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php if (empty($materi)): ?>
                <tr>
                  <td class="text-left">-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden z-50">
    <div class="bg-white rounded shadow-md p-6 w-96">
      <p class="text-gray-800 text-lg mb-4">Yakin ingin menghapus materi ini?</p>
      <div class="flex justify-end space-x-3">
        <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</button>
        <form id="deleteForm" method="post" class="inline">
          <?= csrf_field() ?>
          <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#materiTable').DataTable();
      setTimeout(() => $('#flash-message').fadeOut(), 5000);
    });

    function toggleDropdown() {
      document.getElementById('dropdown').classList.toggle('hidden');
    }

    function confirmDelete(id) {
      document.getElementById('deleteForm').action = "<?= base_url('materi/delete/') ?>" + id;
      document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('deleteModal').classList.add('hidden');
    }
  </script>

</body>

</html>