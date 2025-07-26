<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
  <style>
    table.dataTable {
      border-collapse: collapse !important;
      width: 100%;
      background-color: #ffffff;
      border: 1px solid #e5e7eb;
    }

    table.dataTable thead th {
      font-size: 16px;
      padding: 14px 16px;
      border: 1px solid #e5e7eb;
      background-color: #f3f4f6;
      color: #111827;
      text-align: left;
    }

    table.dataTable tbody td {
      font-size: 15px;
      padding: 12px 16px;
      border: 1px solid #e5e7eb;
      color: #374151;
      background-color: #fff;
    }

    .dataTables_wrapper {
      margin-top: 1.5rem;
      padding-left: 1rem;
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

        <div class="flex justify-between items-center mb-4">
          <h1 class="text-xl font-semibold text-gray-800">Daftar Pengguna</h1>
          <a href="<?= base_url('user/create') ?>"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
            + Tambah User
          </a>
        </div>

        <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
          <table id="userTable" class="w-full table-auto text-left text-sm text-gray-800">
            <thead class="bg-gray-100 text-xs text-gray-600 uppercase">
              <tr>
                <th class="px-4 py-3">Nama</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Role</th>
                <th class="px-4 py-3 text-right">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr class="border-b hover:bg-gray-50">
                  <td class="px-4 py-3 font-medium"><?= esc($user['name']) ?></td>
                  <td class="px-4 py-3"><?= esc($user['email']) ?></td>
                  <td class="px-4 py-3 capitalize"><?= esc($user['role']) ?></td>
                  <td class="px-4 py-3 text-left">
                    <a href="<?= base_url('user/detail/' . $user['id']) ?>" class="text-blue-600 hover:underline mr-3">Detail</a>
                    <a href="<?= base_url('user/edit/' . $user['id']) ?>"
                      class="text-yellow-600 hover:underline mr-3">Edit</a>
                    <?php if ($user['id'] == session('user_id')): ?>
                      <button class="text-gray-400 cursor-not-allowed" disabled>Hapus</button>
                    <?php else: ?>
                      <button onclick="confirmDelete(<?= $user['id'] ?>)"
                        class="text-red-600 hover:underline">Hapus</button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
              <?php if (empty($users)): ?>
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
      <p class="text-gray-800 text-lg mb-4">Yakin ingin menghapus user ini?</p>
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
      $('#userTable').DataTable();
      setTimeout(() => $('#flash-message').fadeOut(), 5000);
    });

    function confirmDelete(id) {
      document.getElementById('deleteForm').action = "<?= base_url('user/delete/') ?>" + id;
      document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('deleteModal').classList.add('hidden');
    }

    function toggleDropdown() {
      document.getElementById('dropdown').classList.toggle('hidden');
    }
  </script>
</body>

</html>