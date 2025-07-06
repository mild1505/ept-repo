<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($GLOBALS['page_data']['title'] ?? 'Akun - Default Title') ?></title>
    <meta name="csrf-token" content="<?= generateCsrfToken() ?>">
    <meta name="description" content="<?= htmlspecialchars($GLOBALS['page_data']['meta']['description'] ?? 'Default Description') ?>">
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <a href="/akun/manage">Manajemen Akun</a>
            </div>
            
            <nav class="main-nav">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="user-info">
                        <span class="username">
                            <?= htmlspecialchars($_SESSION['user']['name']) ?>
                            <small>(<?= htmlspecialchars($_SESSION['user']['role']) ?>)</small>
                        </span>
                        <div class="dropdown">
                            <a href="/akun/profile">Profil</a>
                            <form action="/akun/logout" method="POST" class="logout-form">
                                <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/akun/login" class="login-btn">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container">
        