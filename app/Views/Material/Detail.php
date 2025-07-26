<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detail Materi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="flex min-h-screen">
  <?= view('Bar/Sidebar') ?>

  <main class="flex-1 bg-gray-50">
    <?= view('Bar/Topbar') ?>

    <div class="px-6 py-8">
      <div class="bg-white rounded-xl shadow p-8 max-w-6xl mx-auto space-y-8">

        <div>
          <h2 class="text-2xl font-bold text-gray-800"><?= esc($materi['title']) ?></h2>
        </div>

        <hr>

        <?php if ($materi['thumbnail']): ?>
          <div>
            <h3 class="font-semibold text-gray-700 mb-2">Thumbnail</h3>
            <img src="<?= base_url($materi['thumbnail']) ?>" alt="Thumbnail" class="rounded-lg max-w-md border">
          </div>
          <hr>
        <?php endif; ?>

        <div>
          <h3 class="font-semibold text-gray-700 mb-2">Deskripsi</h3>
          <div class="prose max-w-none">
            <?= $materi['description'] ?>
          </div>
        </div>

        <hr>

        <div class="flex justify-between items-center flex-wrap gap-4 pt-4">
          <div class="text-sm text-gray-600">
            Jenis Materi: <span class="font-medium"><?= ucfirst($materi['type']) ?></span>
          </div>
          <div class="flex gap-3">
            <?php if ($materi['file_path']): ?>
              <a href="<?= base_url($materi['file_path']) ?>" download
                 class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-md text-sm font-medium">
                Download Materi
              </a>
            <?php endif; ?>
            <a href="<?= base_url('materi') ?>"
               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-md text-sm font-medium">
              Kembali ke Daftar
            </a>
          </div>
        </div>

      </div>
    </div>
  </main>
</div>

<script>
  function toggleDropdown() {
    const menu = document.getElementById('dropdown');
    menu.classList.toggle('hidden');
  }
</script>

</body>
</html>
