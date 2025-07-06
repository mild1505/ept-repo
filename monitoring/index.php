<?php
declare(strict_types=1);

ob_start();
session_start();

// START SESSION di awal file
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400, // 1 hari
        'cookie_secure'   => true,  // HTTPS only
        'cookie_httponly' => true   // Anti XSS
    ]);
}

// Buat container untuk data global
// $GLOBALS['page_data'] = [
//     'title' => 'Default Title',
//     'meta' => [
//         'description' => 'Default Description'
//     ]
// ];

// Set base path untuk include file
// define('BASE_PATH', __DIR__ . '/');

// Autoload dan session start
require __DIR__ . '/src/config/database.php';
require __DIR__ . '/src/includes/header.php';

// Routing
$request = $_GET['url'] ?? 'home';

if ($request === 'logout') {
    require __DIR__ . '/src/includes/auth.php';
    logout();
}

$routes = [
    'home'      => '/src/pages/home.php',
    'dashboard' => '/src/pages/dashboard.php',
    'login'     => '/src/pages/login.php',
    'test-db'   => '/src/pages/test-koneksi.php'
];

if (isset($routes[$request])) {
    require __DIR__ . $routes[$request];
} else {
    http_response_code(404);
    require __DIR__ . '/src/pages/404.php';
}

require __DIR__ . '/src/includes/footer.php';

// Output final
ob_end_flush();
echo ob_get_clean();
?>