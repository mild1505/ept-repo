<?php require __DIR__ . '/../partials/header.php'; ?>

<div class="auth-container">
    <h2>Login</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
        
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="/akun/register">Daftar disini</a></p>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>