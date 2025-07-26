<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login Akun</h2>

            <?php if (session()->getFlashdata('success')): ?>
                <div id="notif" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div id="notif" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/process') ?>" method="post" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="text" name="email" id="email"
                        class="mt-1 block w-full px-4 py-2 border <?= session('errors.email') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                        value="<?= old('email') ?>" placeholder="Email terdaftar">
                    <?php if (session('errors.email')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= esc(session('errors.email')) ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full px-4 py-2 border <?= session('errors.password') ? 'border-red-500' : 'border-gray-300' ?> rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Password akun">
                    <?php if (session('errors.password')): ?>
                        <p class="text-red-500 text-sm mt-1"><?= esc(session('errors.password')) ?></p>
                    <?php endif; ?>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">Login</button>
            </form>

            <p class="mt-4 text-center text-sm">Belum punya akun?
                <a href="<?= base_url('register') ?>" class="text-blue-600 hover:underline">Daftar sekarang</a>
            </p>

            <p class="mt-2 text-center text-sm">
                <a href="<?= base_url('/') ?>" class="text-gray-600 hover:text-blue-600 hover:underline">← Kembali ke
                    Beranda</a>
            </p>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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