<?php
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Path to Laravel app root (outside public_html)
$laravelRoot = dirname(__DIR__) . '/../laravel-app'; // <-- Adjust this to your Laravel folder

// Maintenance mode check
if (file_exists($laravelRoot . '/../storage/framework/maintenance.php')) {
    require $laravelRoot . '/../storage/framework/maintenance.php';
}

// Autoloader
require $laravelRoot . '/../vendor/autoload.php';

// Bootstrap the application
$app = require_once $laravelRoot . '/../bootstrap/app.php';

// Handle the request
$kernel = $app->make(Kernel::class);
$response = $kernel->handle(
    $request = Request::capture()
);
$response->send();
$kernel->terminate($request, $response);
