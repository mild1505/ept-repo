<?php

$host = '10.10.10.71';
$port = '5432';
$dbname = 'eprotrack';
$user = 'eptnevo';
$password = 'Nevo@2022#G0r0nt4l0';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    echo "Koneksi PostgreSQL berhasil!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>