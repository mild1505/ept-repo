<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Register user baru (status pending)
    public function register($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (username, name, email, password_hash, role, is_active) 
            VALUES (?, ?, ?, ?, 'user', FALSE)
        ");
        return $stmt->execute([
            $data['username'],
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    // Approve user oleh admin
    public function approve($userId) {
        $stmt = $this->pdo->prepare("
            UPDATE users SET is_active = TRUE WHERE id = ?
        ");
        return $stmt->execute([$userId]);
    }

    // CRUD Operations
    public function getAllUsers() {
        $stmt = $this->pdo->query("
            SELECT id, username, name, email, role, is_active 
            FROM users
        ");
        return $stmt->fetchAll();
    }

    public function deleteUser($userId) {
        $stmt = $this->pdo->prepare("
            DELETE FROM users WHERE id = ?
        ");
        return $stmt->execute([$userId]);
    }

    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("
            SELECT * FROM users 
            WHERE username = ? 
            LIMIT 1
        ");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function getActiveUsers() {
        $stmt = $this->pdo->query("
            SELECT id, username, name, role 
            FROM users 
            WHERE is_active = TRUE
            ORDER BY created_at DESC
        ");
        return $stmt->fetchAll();
    }

    public function getPendingUsers() {
        $stmt = $this->pdo->query("
            SELECT id, username, email, created_at 
            FROM users 
            WHERE is_active = FALSE
            ORDER BY created_at DESC
        ");
        return $stmt->fetchAll();
    }
}
?>