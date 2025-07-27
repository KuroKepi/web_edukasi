<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tentang Kami</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

  <div class="flex min-h-screen">
    <aside class="w-64 bg-white shadow-md">
      <div class="p-6 text-xl font-bold text-blue-600 border-b border-gray-200">
        📘 Navigasi
      </div>
      <nav class="p-4 space-y-2 text-gray-700">
        <a href="/" class="block px-4 py-2 rounded hover:bg-blue-100">🏠 Beranda</a>
        <a href="/about" class="block px-4 py-2 rounded hover:bg-blue-100 font-semibold">ℹ️ Tentang Kami</a>
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

      <div class="px-6 py-8">
        <div class="bg-white rounded-xl shadow p-8 max-w-6xl mx-auto space-y-6">
          <div>
            <h2 class="text-2xl font-bold text-gray-800">Tentang Kami</h2>
          </div>

          <hr>

          <div class="text-gray-700 text-sm space-y-2 leading-relaxed">
            <p><strong>Nama Kelompok:</strong></p>
            <ul class="list-disc list-inside">
              <li>MUHAMMAD ARFANI (230401010086)</li>
              <li>MAFASYAFA ANNISA ZUKHRUFF (230401010036)</li>
              <li>ZELDA ELISA HIJRY (230401010046)</li>
            </ul>

            <p class="pt-4"><strong>Kelas Kelompok:</strong> IF 401</p>
            <p><strong>Nama Mata Kuliah:</strong> Pemrograman Web II</p>

            <p><strong>Akun Demo Admin:</strong></p>
            <ul class="list-disc list-inside">
              <li>John@gmail.com password:user123 role:admin</li>
              <li>Admin@gmail.com password:user123 role:admin</li>
            </ul>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>

</html>