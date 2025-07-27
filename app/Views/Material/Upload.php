<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload Materi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
  <style>
    trix-toolbar [data-trix-button-group="file-tools"] {
      display: none;
    }
  </style>
</head>

<body class="bg-gray-100 font-sans">
  <div class="flex min-h-screen">

    <?= view('Bar/Sidebar') ?>

    <main class="flex-1 bg-gray-50">
      <?= view('Bar/Topbar') ?>

      <div class="px-6 py-8">
        <div class="bg-white rounded-xl shadow p-8 max-w-6xl mx-auto">
          <form action="<?= base_url('materi/save') ?>" method="post" enctype="multipart/form-data" class="space-y-8">
            <?= csrf_field() ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Materi <span
                    class="text-red-500">*</span></label>
                <input type="text" name="title" required
                  class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Materi <span
                    class="text-red-500">*</span></label>
                <select name="type" required
                  class="w-full px-4 py-2 bg-white text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none">
                  <option value="">-- Pilih Jenis --</option>
                  <option value="artikel">Artikel</option>
                  <option value="ebook">E-Book</option>
                  <option value="image">Gambar</option>
                  <option value="audio">Audio</option>
                  <option value="video">Video</option>
                </select>
              </div>
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi <span
                    class="text-red-500">*</span></label>
                <input id="deskripsi" type="hidden" name="description" required>
                <trix-editor input="deskripsi"
                  class="trix-content bg-white border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 min-h-[200px]"></trix-editor>
              </div>
              <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">File Materi (Max 10MB)</label>
                <div class="w-full bg-gray-50 border border-dashed border-gray-300 rounded-lg p-4">
                  <input type="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.mp4,.mp3,.wav"
                    class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                </div>
              </div>
              <div class="md:col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Thumbnail (Gambar Max 10MB)</label>
                <div class="w-full bg-gray-50 border border-dashed border-gray-300 rounded-lg p-4">
                  <input type="file" name="thumbnail" accept="image/*"
                    class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-gray-600 file:text-white hover:file:bg-gray-700">
                </div>
              </div>
            </div>

            <div class="flex justify-end pt-4 space-x-2">
              <a href="<?= base_url('materi') ?>"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                ❌ Batal
              </a>
              <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-all duration-200">
                🚀 Upload Sekarang
              </button>
            </div>

          </form>
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