<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// generate app key
$router->get('/key', function() {
    return str_random(32);
});

// root URL
$router->get('/', function() {
    return view('docs');
});


// JWT routes
$router->post('/auth/register', 'AuthController@create');

$router->post('/auth/login', 'AuthController@login');

$router->group(['middleware'=>'auth'], function($router){

    $router->get('/me', 'AuthController@me');

    $router->get('/logout', 'AuthController@logout');

    $router->post('/bucketlists/', 'BucketlistController@store');

    $router->get('/bucketlists/{paginate}', 'BucketlistController@index');

    $router->get('/bucketlist/{id}', 'BucketlistController@show');

    $router->put('/bucketlists/{bucketlist_id}', 'BucketlistController@update');

    $router->delete('/bucketlist/{id}', 'BucketlistController@destroy');

    $router->post('/bucketlists/{id}/items/', 'ListItemController@store');

    $router->get('/bucketlists/{id}/items', 'ListItemController@index');

    $router->get('/bucketlists/{id}/items/{item_id}', 'ListItemController@show');

    $router->put('/bucketlists/{id}/items/{item_id}', 'ListItemController@update');

    $router->delete('/bucketlists/{id}/items/{item_id}', 'ListItemController@destroy');

    $router->get('/bucketlists/q/{q}/', 'BucketlistController@search');
});
