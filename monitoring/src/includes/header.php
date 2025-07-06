<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($GLOBALS['page_data']['title'] ?? 'Default Title') ?></title>
    <meta name="description" content="<?= htmlspecialchars($GLOBALS['page_data']['meta']['description'] ?? 'Default Description') ?>">
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="/monitoring/home">Home</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/monitoring/dashboard">Dashboard</a>
                <a href="logout">Logout</a>
                <!-- <form action="/logout" method="POST" style="display: inline;">
                    <button type="submit" class="btn-logout">Logout</button>
                </form> -->
                <span class="user-info">Hi, <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></span>
            <?php else: ?>
                <a href="/monitoring/login">Login</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        