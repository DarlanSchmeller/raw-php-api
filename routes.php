<?php

// Register routes
$router->registerRoute('GET', '/users', 'CustomerController@index');
$router->registerRoute('POST', '/users', 'CustomerController@create');
$router->registerRoute('GET', '/users/{id}', 'CustomerController@show');
