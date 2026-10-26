<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

$router->get('/', function () {
    return response()->json([
        'service_name' => 'PHP Service App',
        'status' => 'Running'
    ]);
});

$router->get('/hello-lumen', function () {
    return "<h1>Lumen</h1><p>Hi good developer, thank for using Lumen</p>";
});

$router->get('/hello-lumen/{name}', function ($name) {
    return "<h1>Lumen</h1><p>Hi <b>" . $name . "</b>, thank for using Lumen</p>";
});

$router->get('/scores', ['middleware' => 'login', function () {
    return "<h1>Selamat</h1><p>Nilai anda 100</p>";
}]);

$router->get('/users', 'UsersController@index');
$router->get('/users/{userId}', 'UsersController@show');

$router->get('/posts', 'PostsController@index');
$router->post('/posts', 'PostsController@store');
$router->get('/post/{postId}', 'PostsController@show');
$router->put('/post/{postId}', 'PostsController@update');
$router->delete('/post/{postId}', 'PostsController@destroy');

$router->get('/anggota', 'AnggotaController@index');
$router->get('/petugas', 'PetugasController@index');
$router->get('/peminjaman', 'PeminjamanController@index');
$router->get('/pengembalian', 'PengembalianController@index');

$router->get('/buku', 'BukuController@index');
$router->get('/buku/tersedia', 'BukuController@tersedia');
$router->get('/buku/jumlah', 'BukuController@jumlah');
$router->put('/buku/{id}/tambah-stok', 'BukuController@tambahStok');

$router->get('/products', 'ProductsController@index');
$router->post('/products', 'ProductsController@store');
$router->get('/product/{productId}', 'ProductsController@show');
$router->put('/product/{productId}', 'ProductsController@update');
$router->delete('/product/{productId}', 'ProductsController@destroy');