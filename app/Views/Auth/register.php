<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Form Registrasi</h2>
            <?php if (session()->getFlashdata('success')): ?>
                <div id="notif" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('register/process') ?>" method="post" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full px-4 py-2 border <?= session('errors.name') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                        value="<?= old('name') ?>" placeholder="Nama Lengkap">
                    <?php if (session('errors.name')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= esc(session('errors.name')) ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" id="email"
                        class="mt-1 block w-full px-4 py-2 border <?= session('errors.email') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                        value="<?= old('email') ?>" placeholder="Email Aktif">
                    <?php if (session('errors.email')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= esc(session('errors.email')) ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-4 py-2 border <?= session('errors.password') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Minimal 6 karakter">
                    <?php if (session('errors.password')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= esc(session('errors.password')) ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Daftar</button>
            </form>

            <p class="mt-4 text-center text-sm">Sudah punya akun?
                <a href="<?= base_url('login') ?>" class="text-blue-600 hover:underline">Login</a>
            </p>

            <p class="mt-2 text-center text-sm">
                <a href="<?= base_url('/') ?>" class="text-gray-600 hover:text-blue-600 hover:underline">← Kembali ke
                    Beranda</a>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fields = ['name', 'email', 'password'];

            fields.forEach(fieldId => {
                const input = document.getElementById(fieldId);
                const errorText = input.parentElement.querySelector('p.text-red-500');

                input.addEventListener('input', function () {
                    if (input.value.trim() !== '') {
                        input.classList.remove('border-red-500');
                        input.classList.add('border-gray-300');
                        if (errorText) errorText.style.display = 'none';
                    }
                });
            });

            const notif = document.getElementById('notif');
            if (notif) {
                setTimeout(() => {
                    notif.style.display = 'none';
                }, 5000);
            }
        });
    </script>

</body>

</html>