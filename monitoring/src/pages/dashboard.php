<?php
$Title = "Dashboard";
$Meta_Desc = "Dashboard Pengguna";
// $GLOBALS['page_data']['title'] = "Dashboard";
// $GLOBALS['page_data']['meta']['description'] = "Dashboard pengguna";

// Contoh autentikasi
require_once __DIR__ . '/../includes/auth.php';
checkLogin();

// Validasi CSRF untuk semua POST request
validateCsrfToken();

// Ambil data dari database
$userId = $_SESSION['user_id'] ?? null;
$user = fetchUser((int)$userId);
?>

<h1>Dashboard</h1>
<?php if ($user): ?>
    <div class="profile">
        <h2>Halo, <?= htmlspecialchars($user['username']) ?></h2>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <p>IP: <?= htmlspecialchars($_SERVER['REMOTE_ADDR']) ?></p>
        <p>Browser: <?= htmlspecialchars($_SERVER['HTTP_USER_AGENT']) ?></p>
    </div>
<?php endif; ?>