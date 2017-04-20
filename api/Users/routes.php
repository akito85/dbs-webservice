
<?php

$router->get('/users', 'UserController@getAll');
$router->get('/users/{id}', 'UserController@getById');
$router->post('/users', 'UserController@create');
$router->put('/users/{id}', 'UserController@update');
$router->patch('/users/{id}', 'UserController@update');
$router->delete('/users/{id}', 'UserController@delete');

$router->get('/drivers', 'DriverController@getAll');
$router->post('/drivers', 'DriverController@getAll');

$router->get('/trips', 'TripController@getAll');