<?php

// Register routes
$router->registerRoute('GET', '/customers', 'CustomerController@index');
$router->registerRoute('GET', '/customers/{id}', 'CustomerController@show');
$router->registerRoute('POST', '/customers', 'CustomerController@create');
$router->registerRoute('PUT', '/customers/{id}', 'CustomerController@update');
$router->registerRoute('DELETE', '/customers/{id}', 'CustomerController@destroy');
