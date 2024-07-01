<?php

use Slim\Factory\AppFactory;
use Slim\App;

require __DIR__ . '/../vendor/autoload.php';

// Create Slim app
$app = AppFactory::create();

// Register middleware
(require __DIR__ . '/../app/middleware.php')($app);

// Register routes
(require __DIR__ . '/../app/routes.php')($app);

// Run Slim app
$app->run();