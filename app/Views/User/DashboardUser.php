<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Dashboard User</title>
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
    }

    table.dataTable tbody td {
      font-size: 15px;
      padding: 12px 16px;
      border: 1px solid #e5e7eb;
      background-color: #fff;
      color: #374151;
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
        <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
          <table id="materiTable" class="w-full table-auto text-left text-sm text-gray-800">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Jenis</th>
                <th>Tanggal Persetujuan</th>
                <th class="text-left">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($materi)): ?>
                <?php foreach ($materi as $m): ?>
                  <tr>
                    <td><?= esc($m['title']) ?></td>
                    <td><?= esc($m['type']) ?></td>
                    <td>
                      <?= $m['approved_at'] ? date('d M Y H:i', strtotime($m['approved_at'])) : '-' ?>
                    </td>
                    <td>
                      <a href="<?= base_url('user/dashboard/detail/' . $m['id']) ?>" class="text-blue-600 hover:underline">
                        Detail
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#materiTable').DataTable();
    });
    function toggleDropdown() {
      document.getElementById('dropdown').classList.toggle('hidden');
    }
  </script>
</body>

</html>