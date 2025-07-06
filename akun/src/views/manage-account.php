<?php
$Title = "e-ProTrack - Manajemen Akun";
$Meta_Desc = "Manajemen Akun";
// $GLOBALS['page_data']['title'] = "Home";
// $GLOBALS['page_data']['meta']['description'] = "Rumah pengguna";
?>


<h1>Manajemen Akun</h1>
<p>Nama: <?= htmlspecialchars($user['name']) ?></p>
<p>Role: <?= htmlspecialchars($user['role']) ?></p>

<form action="/akun/update" method="POST">
    <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
    <input type="text" name="new_name" value="<?= htmlspecialchars($user['name']) ?>">
    <button type="submit">Update</button>
</form>