<?php
$Title = "Home";
$Meta_Desc = "Rumah Pengguna";
// $GLOBALS['page_data']['title'] = "Home";
// $GLOBALS['page_data']['meta']['description'] = "Rumah pengguna";
?>

<h1>Selamat Datang</h1>
<p>Ini adalah halaman utama</p>

<?php
// Contoh penggunaan PDO
$users = $pdo->query("SELECT * FROM users LIMIT 5")->fetchAll();
foreach ($users as $user) {
    echo "<p>{$user['username']}</p>";
}
?>