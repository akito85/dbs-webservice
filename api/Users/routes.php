
<?php

$router->get('/checkpoints', 'CheckpointController@getAll');
$router->get('/checkpoints/{id}', 'CheckpointController@getById');
$router->post('/checkpoints', 'CheckpointController@create');
$router->put('/checkpoints/{id}', 'CheckpointController@update');
$router->patch('/checkpoints/{id}', 'CheckpointController@update');
$router->delete('/checkpoints/{id}', 'CheckpointController@delete');

$router->get('/divisions', 'DivisionController@getAll');
$router->get('/divisions/{id}', 'DivisionController@getById');
$router->post('/divisions', 'DivisionController@create');
$router->put('/divisions/{id}', 'DivisionController@update');
$router->patch('/divisions/{id}', 'DivisionController@update');
$router->delete('/divisions/{id}', 'DivisionController@delete');

$router->get('/drivers', 'DriverController@getAll');
$router->get('/drivers/{id}', 'DriverController@getById');
$router->post('/drivers', 'DriverController@create');
$router->post('/drivers/syncUser/{userToken}', 'DriverController@syncUser');
$router->patch('/drivers/{id}', 'DriverController@update');
$router->delete('/drivers/{id}', 'DriverController@delete');

$router->get('/feedbacks', 'FeedbackController@getAll');
$router->get('/feedbacks/{id}', 'FeedbackController@getById');
$router->post('/feedbacks', 'FeedbackController@create');
$router->put('/feedbacks/{id}', 'FeedbackController@update');
$router->patch('/feedbacks/{id}', 'FeedbackController@update');
$router->delete('/feedbacks/{id}', 'FeedbackController@delete');

$router->get('/regions', 'RegionController@getAll');
$router->get('/regions/{id}', 'RegionController@getById');
$router->post('/regions', 'RegionController@create');
$router->put('/regions/{id}', 'RegionController@update');
$router->patch('/regions/{id}', 'RegionController@update');
$router->delete('/regions/{id}', 'RegionController@delete');

$router->get('/sites', 'SiteController@getAll');
$router->get('/sites/{id}', 'SiteController@getById');
$router->post('/sites', 'SiteController@create');
$router->put('/sites/{id}', 'SiteController@update');
$router->patch('/sites/{id}', 'SiteController@update');
$router->delete('/sites/{id}', 'SiteController@delete');

$router->get('/trips', 'TripController@getAll');
$router->get('/trips/{id}', 'TripController@getById');
$router->post('/trips', 'TripController@create');
$router->put('/trips/{id}', 'TripController@update');
$router->patch('/trips/{id}', 'TripController@update');
$router->delete('/trips/{id}', 'TripController@delete');

$router->get('/users', 'UserController@getAll');
$router->get('/users/{id}', 'UserController@getById');
$router->post('/users', 'UserController@create');
$router->post('/users/syncDriver/{driverToken}', 'UserController@syncDriver');
$router->post('/users/testSyncDriver', 'UserController@testSyncDriver');
$router->put('/users/{id}', 'UserController@update');
$router->patch('/users/{id}', 'UserController@update');
$router->delete('/users/{id}', 'UserController@delete');
$router->post('/users/testAddTrip', 'UserController@testAddTrip');

$router->get('/vehicles', 'VehicleController@getAll');
$router->get('/vehicles/{id}', 'VehicleController@getById');
$router->post('/vehicles', 'VehicleController@create');
$router->put('/vehicles/{id}', 'VehicleController@update');
$router->patch('/vehicles/{id}', 'VehicleController@update');
$router->delete('/vehicles/{id}', 'VehicleController@delete');

$router->get('/waypoints', 'WaypointController@getAll');
$router->get('/waypoints/{id}', 'WaypointController@getById');
$router->post('/waypoints', 'WaypointController@create');
$router->put('/waypoints/{id}', 'WaypointController@update');
$router->patch('/waypoints/{id}', 'WaypointController@update');
$router->delete('/waypoints/{id}', 'WaypointController@delete');

$router->post('universalPush/{deviceToken}', 'UniversalPushController@push');