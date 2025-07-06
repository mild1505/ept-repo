<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        global $pdo;
        $this->model = new UserModel($pdo);
    }

    public function manage() {
        // Hanya admin yang bisa akses
        if ($_SESSION['user']['role'] !== 'admin') {
            header('Location: /akun/403');
            exit;
        }

        $activeUsers = $this->model->getActiveUsers();
        $pendingUsers = $this->model->getPendingUsers();

        require __DIR__ . '/../views/user/manage.php';
    }
}