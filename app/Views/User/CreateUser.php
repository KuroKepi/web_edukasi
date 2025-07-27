<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buat Pengguna Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <?= view('Bar/Sidebar') ?>
        <main class="flex-1 bg-gray-50">
            <?= view('Bar/Topbar') ?>

            <div class="px-6 py-8">
                <div class="bg-white rounded-xl shadow p-8 max-w-4xl mx-auto">

                    <?php if (session()->getFlashdata('success')): ?>
                        <div id="notif" class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('user/store') ?>" method="post" class="space-y-8">
                        <?= csrf_field() ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" value="<?= old('name') ?>"
                                    class="w-full px-4 py-2 border <?= session('errors.name') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <?php if (session('errors.name')): ?>
                                    <p class="text-red-500 text-sm mt-1"><?= esc(session('errors.name')) ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                        class="text-red-500">*</span></label>
                                <input type="email" name="email" value="<?= old('email') ?>"
                                    class="w-full px-4 py-2 border <?= session('errors.email') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <?php if (session('errors.email')): ?>
                                    <p class="text-red-500 text-sm mt-1"><?= esc(session('errors.email')) ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Password <span
                                        class="text-red-500">*</span></label>
                                <input type="password" name="password"
                                    class="w-full px-4 py-2 border <?= session('errors.password') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <?php if (session('errors.password')): ?>
                                    <p class="text-red-500 text-sm mt-1"><?= esc(session('errors.password')) ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Role <span
                                        class="text-red-500">*</span></label>
                                <select name="role" required
                                    class="w-full px-4 py-2 bg-white border <?= session('errors.role') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="user" <?= old('role') === 'user' ? 'selected' : '' ?>>User</option>
                                </select>
                                <?php if (session('errors.role')): ?>
                                    <p class="text-red-500 text-sm mt-1"><?= esc(session('errors.role')) ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 space-x-2">
                            <a href="<?= base_url('user') ?>"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg text-sm font-medium">
                                ❌ Batal
                            </a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium">
                                ✅ Buat Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fields = ['name', 'email', 'password'];
            fields.forEach(fieldId => {
                const input = document.querySelector(`[name="${fieldId}"]`);
                const errorText = input?.parentElement.querySelector('p.text-red-500');
                input?.addEventListener('input', function () {
                    input.classList.remove('border-red-500');
                    input.classList.add('border-gray-300');
                    if (errorText) errorText.style.display = 'none';
                });
            });

            const notif = document.getElementById('notif');
            if (notif) {
                setTimeout(() => notif.style.display = 'none', 5000);
            }
        });
        function toggleDropdown() {
            document.getElementById('dropdown').classList.toggle('hidden');
        }
    </script>

</body>

</html>