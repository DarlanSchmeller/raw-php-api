<?php

require_once 'bootstrap.php';

use Framework\Router;

// Get a new router instance and register routes
$router = new Router();
require_once 'routes.php';

$router->handleRequest();