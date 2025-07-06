<?php
require_once __DIR__ . '/../config/csrf.php';
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $model;

    public function __construct() {
        global $pdo;
        $this->model = new UserModel($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF Protection
            if (!validateCsrfToken($_POST['csrf_token'] ?? null)) {
                require __DIR__ . '/../views/errors/403.php';
                exit;
            }

            // Proses login
            $user = $this->model->getUserByUsername($_POST['username']);

            if ($user && password_verify($_POST['password'], $user['password_hash'])) {
                if ($user['is_active']) {
                    $_SESSION['user'] = $user;
                    header('Location: /akun/manage');
                    exit;
                } else {
                    $error = "Akun menunggu persetujuan admin";
                }
            } else {
                $error = "Username/password salah";
            }
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validateCsrfToken($_POST['csrf_token'])) {
                require __DIR__ . '/../views/errors/403.php';
                exit;
            }

            if ($this->model->register($_POST)) {
                $success = "Pendaftaran berhasil! Menunggu persetujuan admin.";
            } else {
                $error = "Pendaftaran gagal";
            }
        }

        require __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /akun');
        exit;
    }
}
?>