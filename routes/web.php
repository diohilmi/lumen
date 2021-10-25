<?php

use Illuminate\Support\Str; // import library Str
// use Illuminate\Validation\Validator;
// use Laravel\Lumen\Http\Request;

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function () {
    return Str::random(32);
});

// DATETIME pak buce
$router->get('/datetime', 'myController@index' );

// luas lingkaran & crud sederhana
// $router->post('/posts', 'PostController@index' ); luas lingkaran
$router->get('/posts', 'PostController@index' );
$router->post('/posts', 'PostController@store' );
$router->delete('/posts/{id}', 'PostController@delete' );
$router->put('/posts/{id}', 'PostController@update' );
$router->get('/posts/{id}', 'PostController@show' );

// praktikum method
$router->get('/get', function () {
return 'GET';
});
$router->post('/post', function () {
return 'POST';
});
$router->put('/put', function () {
return 'PUT';
});
$router->patch('/patch', function () {
return 'PATCH';
});
$router->delete('/delete', function () {
return 'DELETE';
});
$router->options('/options', function () {
return 'OPTIONS';
});

// dynamic route
$router->get('/user/{id}', function ($id) {
    return 'User Id = ' . $id;
});

//dynamic route dua variabel
$router->get('/post/{postId}/comments/{commentId}', function ($postId, $commentId) {
    return 'Post ID = ' . $postId . ' Comments ID = ' . $commentId;
});

//dynamic route opsional
// $router->get('/users[/{userId}]', function ($userId = null) {
//     return $userId === null ? 'Data semua users' : 'Data user dengan id ' . $userId;
// });


//aliases route
$router->get('auth/login', ['as' => 'route.auth.login', function () {
    return 'Anda berhasil login';
}]);

$router->get('profile', function () {
    // if ($request->isLoggedIn) {
            return redirect()->route('route.auth.login');
    // }
});



//group route
$router->group(['prefix' => 'users'], function () use ($router) {
    $router->get('/', function () {               // menjadi /users/, /users => prefix, / => path
            return "GET /users";
    });
});

//middleware
$router->get('/admin/home/', ['middleware' => 'age', function () {
    return 'Dewasa';
}]);

$router->get('/fail', function () {
    return 'Dibawah umur';
});

//kuis
//administrasi mengakses mhs yang belum dregistrasi
$router->get('/mhs', 'mhsController@index' );

//mahasiswa mengambil khs dan sudah registrasi
$router->get('/krs', 'krsController@index' );
$router->post('/krs/{id_mhs}', 'krsController@store' );
$router->delete('/krs/{id}', 'krsController@delete' );
$router->get('/krs/{id}', 'krsController@show' );


//praktikum
$router->get('/praktikum', ['uses' => 'P_Controller@index']);
$router->get('/hello', ['uses' => 'P_Controller@hello']);

//middleware pak Buce
$router->get('/umurMiddleware/{umur}', ['middleware' => 'umur', function ($umur){
    return "umur anda sudah " . $umur;
}] );

// Register
$router->post('/register','UserController@register');
// Login
$router->post('/login','UserController@login');
// auth
$router->get('/book','BookController@index');