<?php
declare(strict_types=1);

$host = '10.10.10.71';
$port = '5432';
$dbname = 'ept';
$user = 'ept';
$password = 'MyP4ssW0rd';

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Contoh query
function fetchUser(int $id): ?array {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}
?>
