<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <?= view('Bar/Sidebar') ?>
        <main class="flex-1 bg-gray-50">
            <?= view('Bar/Topbar') ?>

            <div class="px-6 py-8">
                <div class="bg-white rounded-xl shadow p-8 max-w-4xl mx-auto">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Pengguna</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama</label>
                            <p class="text-gray-800 font-medium"><?= esc($user['name']) ?></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                            <p class="text-gray-800"><?= esc($user['email']) ?></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Role</label>
                            <span class="inline-block px-3 py-1 text-sm font-medium rounded-full 
                <?= $user['role'] === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' ?>">
                                <?= ucfirst($user['role']) ?>
                            </span>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Dibuat</label>
                            <p class="text-gray-800">
                                <?= $user['created_at'] ? date('d M Y H:i', strtotime($user['created_at'])) : '-' ?>
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8 space-x-2">
                        <a href="<?= base_url('user') ?>"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg text-sm font-medium">
                            🔙 Kembali
                        </a>
                        <a href="<?= base_url('user/edit/' . $user['id']) ?>"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg text-sm font-medium">
                            ✏️ Edit Pengguna
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        function toggleDropdown() {
            document.getElementById('dropdown').classList.toggle('hidden');
        }
    </script>
</body>

</html>