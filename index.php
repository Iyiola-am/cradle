<?php

use DI\Container;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager;

require_once __DIR__ . '/vendor/autoload.php';

// Load env variables
if (file_exists(__DIR__ . '/.env')) Dotenv::createImmutable(__DIR__)->load();

// Error reporting
switch (getenv('APP_ENVIRONMENT')) {
	case 'production':
		error_reporting(0);
		ini_set('DISPLAY_ERRORS', 'stderr');
		define('SHOW_ERRORS', false);
	break;

	default:
		error_reporting(E_ALL);
		ini_set('DISPLAY_ERRORS', 'stdout');
		define('SHOW_ERRORS', true);
	break;
}

// Connect to the database
$capsule = new Manager;
$capsule->addConnection([
	'driver'    => getenv('DB_DRIVER'),
	'host'      => getenv('DB_HOST'),
	'port'      => getenv('DB_PORT'),
	'database'  => getenv('DB_NAME'),
	'username'  => getenv('DB_USERNAME'),
	'password'  => getenv('DB_PASSWORD'),
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// Create Dependency Injection container
$container = new Container();

// Create slim app from container
$app = AppFactory::createFromContainer($container);

// Register app routes
require_once __DIR__ . '/routes/index.php';

// Run app
$app->run();