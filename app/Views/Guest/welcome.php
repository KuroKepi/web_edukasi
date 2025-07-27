<?php
// Nama Kelompok:
// 1. MUHAMMAD ARFANI (230401010086)
// 2. MAFASYAFA ANNISA ZUKHRUFF (230401010036)
// 3. ZELDA ELISA HIJRY (230401010046)
//
// Kelas Kelompok: IF 401
// Nama Mata Kuliah: Pemrograman Web II
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Beranda - Website Edukasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
</head>

<body class="bg-gray-100 font-sans">
  <div class="flex min-h-screen">
    <aside class="w-64 bg-white shadow-md">
      <div class="p-6 text-xl font-bold text-blue-600 border-b border-gray-200">
        📘 Navigasi
      </div>
      <nav class="p-4 space-y-2 text-gray-700">
        <a href="/" class="block px-4 py-2 rounded hover:bg-blue-100 font-semibold">🏠 Beranda</a>
        <a href="/about" class="block px-4 py-2 rounded hover:bg-blue-100">ℹ️ Tentang Kami</a>
      </nav>
    </aside>

    <main class="flex-1 bg-gray-50">
      <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
        <h1 class="text-xl font-semibold text-gray-700">Website Edukasi</h1>
        <div class="space-x-4 text-sm text-blue-600">
          <a href="/login" class="hover:underline">Masuk</a>
          <span>|</span>
          <a href="/register" class="hover:underline">Daftar</a>
        </div>
      </header>

      <div class="p-6 max-w-7xl mx-auto">
        <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
          <table id="materiTable" class="w-full table-auto text-left text-sm text-gray-800">
            <thead>
              <tr>
                <th>Judul Materi</th>
                <th>Deskripsi Singkat</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($materi)): ?>
                <?php foreach ($materi as $m): ?>
                  <tr>
                    <td><?= esc($m['title']) ?></td>
                    <td><?= ($m['description']) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
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
  </script>
</body>
</html>
