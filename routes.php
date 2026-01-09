<?php

// Register routes
$router->registerRoute('GET', '/users', 'CustomerController@index');
$router->registerRoute('GET', '/users/{id}', 'CustomerController@show');
$router->registerRoute('POST', '/users', 'CustomerController@create');
$router->registerRoute('DELETE', '/users/{id}', 'CustomerController@destroy');
