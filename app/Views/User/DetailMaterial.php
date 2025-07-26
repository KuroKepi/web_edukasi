<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                            <img src="<?= base_url($materi['thumbnail']) ?>" alt="Thumbnail"
                                class="rounded-lg max-w-md border">
                        </div>
                        <hr>
                    <?php endif; ?>

                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Deskripsi</h3>
                        <div class="text-gray-800">
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
                            <a href="<?= base_url('user/dashboard') ?>"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-md text-sm font-medium">
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>

                    <hr class="my-6">

                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Komentar</h3>

                    <?php
                    function renderComments($comments, $parentId = null, $materi, $depth = 0)
                    {
                        foreach ($comments as $k) {
                            if ($k['parent_id'] == $parentId) {
                                echo '<div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mb-3 ml-' . min($depth * 4, 12) . '">';
                                echo '<div class="flex justify-between items-center">';
                                echo '<p class="font-semibold text-gray-700 text-sm">' . esc($k['username']) . '</p>';
                                echo '<p class="text-xs text-gray-500">' . date('d M Y H:i', strtotime($k['created_at'])) . '</p>';
                                echo '</div>';
                                echo '<div class="mt-1 text-gray-800 text-sm leading-relaxed">' . esc($k['content']) . '</div>';

                                if ($materi['is_approved'] == 1) {
                                    echo '<button onclick="toggleReply(' . $k['id'] . ')" class="mt-2 text-sm text-blue-600 hover:underline">Balas</button>';
                                    echo '<form action="' . base_url('user/comment/submit') . '" method="post" class="mt-3 hidden" id="reply-form-' . $k['id'] . '">';
                                    echo csrf_field();
                                    echo '<input type="hidden" name="material_id" value="' . $k['material_id'] . '">';
                                    echo '<input type="hidden" name="parent_id" value="' . $k['id'] . '">';
                                    echo '<textarea name="content" rows="2" required class="w-full border border-gray-300 p-2 rounded mt-2 text-sm" placeholder="Tulis balasan..."></textarea>';
                                    echo '<button type="submit" class="mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 text-sm rounded">Kirim</button>';
                                    echo '</form>';
                                }

                                renderComments($comments, $k['id'], $materi, $depth + 1);
                                echo '</div>';
                            }
                        }
                    }
                    ?>

                    <?php if (!empty($komentar)): ?>
                        <?php renderComments($komentar, null, $materi); ?>
                    <?php else: ?>
                        <p class="text-gray-500 italic">Belum ada komentar.</p>
                    <?php endif; ?>

                    <?php if ($materi['is_approved'] == 1): ?>
                        <div class="mt-6">
                            <form action="<?= base_url('user/comment/submit') ?>" method="post" class="space-y-3">
                                <?= csrf_field() ?>
                                <input type="hidden" name="material_id" value="<?= $materi['id'] ?>">
                                <textarea name="content" rows="4" required
                                    class="w-full border border-gray-300 p-3 rounded text-sm"
                                    placeholder="Tulis komentar kamu..."></textarea>
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded text-sm">
                                    Kirim Komentar
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <p class="text-sm text-gray-400 italic mt-6">Komentar telah ditutup untuk materi ini.</p>
                    <?php endif; ?>

                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleReply(id) {
            const form = document.getElementById('reply-form-' + id);
            form.classList.toggle('hidden');
        }
    </script>

</body>

</html>