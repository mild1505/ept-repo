<?php
declare(strict_types=1);

$Title = "Login";
$Meta_Desc = "Pintu Pengguna";
// $GLOBALS['page_data']['title'] = "Login";
// $GLOBALS['page_data']['meta']['description'] = "Pintu pengguna";

// Redirect jika sudah login
if (isset($_SESSION['user_id'])) {
    header('Location: /dashboard');
    exit;
}

require_once __DIR__ . '/../includes/auth.php';

// Validasi CSRF sebelum proses form
validateCsrfToken();

// Proses form login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // require __DIR__ . '/../../src/includes/auth.php';
    
    try {
        if (loginUser($pdo, $_POST['username'], $_POST['password'])) {
            // Redirect ke URL sebelumnya atau dashboard
            $redirect = $_SESSION['redirect_url'] ?? '/monitoring/dashboard';
            unset($_SESSION['redirect_url']);
            header("Location: $redirect");
            exit;
        } else {
            throw new Exception('Username atau password salah');
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!-- Tampilan HTML -->
<div class="login-container">
    <h2>Login</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    
    <form method="POST" action="/monitoring/login">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>" />
        <div class="form-group">
            <label for="username">Username/Email:</label>
            <input type="text" id="username" name="username" required 
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        
        <button type="submit" class="btn-login">Login</button>
    </form>
</div>