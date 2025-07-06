<?php
declare(strict_types=1);

function checkLogin(): void {
    if (empty($_SESSION['user_id'])) {
        // Simpan URL yang dituju sebelum redirect
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header('Location: /akun/login');
        exit;
    }
}

function loginUser(PDO $pdo, string $username, string $password): bool {
    // Validasi input
    if (empty($username) || empty($password)) {
        throw new Exception('Username dan password harus diisi');
    }

    // Cari user di database
    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    // Verifikasi password
    if ($user && password_verify($password, $user['password_hash'])) {
        // Regenerate session ID
        session_regenerate_id(true);
        
        // Set session
        $_SESSION = [
            'user_id'  => $user['id'],
            'username' => $user['username'],
            'ip'       => $_SERVER['REMOTE_ADDR'], // Tambahan security
            'ua'       => $_SERVER['HTTP_USER_AGENT']
        ];
        
        // Update last login
        $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?")
            ->execute([$user['id']]);
        
        return true;
    }

    return false;
}

function logout(): void {
    // Hapus semua data session
    $_SESSION = [];
    session_destroy();
    
    // Hapus cookie session
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
    
    header('Location: /akun/login');
    exit;
}

// Fungsi generate token
function generateCsrfToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Fungsi validasi token
function validateCsrfToken(): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(403);
            die('Invalid CSRF token');
        }
    }
    unset($_SESSION['csrf_token']);
}


?>