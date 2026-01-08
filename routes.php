<?php

// Register routes
$router->registerRoute('GET', '/users', 'CustomerController@index');
$router->registerRoute('GET', '/users/{id}', 'CustomerController@show');