<?php
require __DIR__ . '/../src/config/database.php';
// require __DIR__ . '/../src/models/UserModel.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';
// require __DIR__ . '/../src/config/constants.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Routing
$request = $_GET['url'] ?? 'login';

switch ($request) {
    // Auth
    case 'login':
        require_once __DIR__ . '/../src/controllers/AuthController.php';
        (new AuthController())->login();
        break;
    case 'register':
        require_once __DIR__ . '/../src/controllers/AuthController.php';
        (new AuthController())->register();
        break;
    case 'logout':
        require_once __DIR__ . '/../src/controllers/AuthController.php';
        (new AuthController())->logout();
        break;
    
    // User Management
    case 'manage':
        require_once __DIR__ . '/../src/controllers/UserController.php';
        (new UserController())->manage();
        break;
    case 'users/list':
        require_once __DIR__ . '/../src/controllers/UserController.php';
        (new UserController())->list();
        break;
    
    default:
        http_response_code(404);
        echo "Halaman tidak ditemukan";
}
?>