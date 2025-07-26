<aside class="w-64 bg-white shadow-lg">
  <div class="p-6 text-xl font-bold text-blue-600 border-b border-gray-200">
    📘 Dashboard User
  </div>
  <nav class="p-4 space-y-2 text-gray-700">
    <a href="<?= base_url('user/dashboard') ?>"
       class="block px-4 py-2 rounded hover:bg-blue-100 <?= current_url() === base_url('user/dashboard') ? 'bg-blue-100 font-semibold' : '' ?>">
      🏠 Dashboard
    </a>

    <a href="<?= base_url('materi') ?>"
       class="block px-4 py-2 rounded hover:bg-blue-100 <?= strpos(current_url(), base_url('materi/')) === 0 && !str_contains(current_url(), 'approval') ? 'bg-blue-100 font-semibold' : '' ?>">
      📚 Materi Edukasi
    </a>

    <a href="<?= base_url('materi/upload') ?>"
       class="block px-4 py-2 rounded hover:bg-blue-100 <?= current_url() === base_url('materi/upload') ? 'bg-blue-100 font-semibold' : '' ?>">
      📤 Upload Materi
    </a>

    <?php if (session('role') === 'admin'): ?>
      <a href="<?= base_url('materi/approval') ?>"
         class="block px-4 py-2 rounded hover:bg-blue-100 <?= current_url() === base_url('materi/approval') ? 'bg-blue-100 font-semibold' : '' ?>">
        ✅ Persetujuan Materi
      </a>

      <a href="<?= base_url('user') ?>"
         class="block px-4 py-2 rounded hover:bg-blue-100 <?= strpos(current_url(), base_url('user')) === 0 && !str_contains(current_url(), 'dashboard') ? 'bg-blue-100 font-semibold' : '' ?>">
        👥 Manajemen Pengguna
      </a>
    <?php endif; ?>
  </nav>
</aside>
