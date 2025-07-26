<header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
  <h1 class="text-xl font-semibold text-gray-700">Website Online Edukasi</h1>
  <div class="relative">
    <button onclick="toggleDropdown()" class="flex items-center space-x-3 focus:outline-none">
      <span class="text-sm text-gray-800 font-medium"><?= session('name') ?></span>
      <svg class="w-4 h-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
      </svg>
    </button>
    <div id="dropdown" class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg hidden z-50">
      <a href="<?= base_url('logout') ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
    </div>
  </div>
</header>
