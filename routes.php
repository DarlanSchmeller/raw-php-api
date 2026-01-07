<?php

// Register routes
$router->registerRoute('/users', 'CustomerController@index');
$router->registerRoute('/users/{id}', 'CustomerController@show');