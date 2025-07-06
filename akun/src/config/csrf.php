<?php
if (!function_exists('generateCsrfToken')) {
    function generateCsrfToken(): string {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('validateCsrfToken')) {
    function validateCsrfToken(?string $token): bool {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return hash_equals($_SESSION['csrf_token'] ?? '', $token ?? '');
    }
}