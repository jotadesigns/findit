<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(
   [
       'prefix' => LaravelLocalization::setLocale(),
       'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
   ],
   function()
   {
       /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
       //principales
       Route::get('/', 'HomeController@index');
       Route::post('/ordenarproductos','PlatoController@ordenarProductos');
       Route::post('/filtrarProductos','PlatoController@filtrarProductos');

       Route::post('/buscar','PlatoController@buscarProductos');
       Route::post('/getrestaurante','RestauranteController@index');
       //rutas de usuario
       Auth::routes();
       Route::get('/home', 'UserController@index');
       Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

       Route::group(['prefix' => 'perfil'], function () {
           Route::get('favoritos', 'UserController@getFav')->name('user.fav');
           Route::get('configuracion', 'UserController@getConfig')->name('user.config');
           Route::get('editar', 'UserController@getEditar')->name('user.edit');
           Route::get('borrar', 'UserController@getBorrar')->name('user.borrar');
           Route::post('config_pass', 'UserController@postChangePassword')->name('user.savepass');
        });

        //conexion facebook
        Route::get('/redirect', 'SocialAuthController@redirect');
        Route::get('/callback', 'SocialAuthController@callback');

        //rutas portal empresas
        Route::get('/empresas', 'PeticionesEmpresaController@index');
        Route::post('/empresas/buscar', 'PeticionesEmpresaController@buscarLocales')->name('empresas.buscar');

   });


//principales
Route::post('/moreproducts','PlatoController@getMoreProducts');


//rutas de usuarios
Route::group(['prefix' => 'perfil'], function () {

    Route::post('config', 'UserController@postSaveConfig')->name('user.saveconfig');
    Route::post('save', 'UserController@postSave')->name('user.save');

});
//usuarios acciones
Route::group(['prefix' => 'accion'], function () {
    Route::post('votar', 'UserController@postVote')->name('accion.votar');
});



//rutas editar restaurantes user R
Route::get('/editarRestaurante', 'RestauranteController@show');
Route::post('/añadirMasPlatosRestaurante', 'PlatoController@crearPlatosRestauranteYaCreado');
Route::post('/editarRestauranteConcreto', 'RestauranteController@edit');
Route::post('/mostrarPlatosBorrar', 'PlatoController@mostrarPlatosBorrar');
Route::post('/borrarPlatos', 'PlatoController@destroy');
Route::post('/DatosModificadosRestaurante', 'RestauranteController@update');
Route::post('/buscarRestaurantesAdmin', 'RestauranteController@buscarRestaurantesAdmin');
Route::post('/ficharRestaurante', 'RestauranteController@ficharRestaurante');
Route::get('/verFichados', 'RestauranteController@verFichados');
Route::post('/introducirMenuRestaurantePendiente', 'RestauranteController@introducirMenuRestaurantePendiente');
Route::post('/introducirPendienteBBDD', 'RestauranteController@introducirPendienteBBDD');
Route::post('/añadirPlatos', 'RestauranteController@platosRestauranteConcreto');
Route::get('/verFichadosParaMasivo', 'RestauranteController@verFichadosParaMasivo');
Route::post('/seleccionRestaurantesMasivo', 'RestauranteController@seleccionRestaurantesMasivo');
Route::post('/introducirMasivoPendienteBBDD', 'RestauranteController@introducirMasivoPendienteBBDD');
Route::post('/buscarRestaurantesMasivo', 'RestauranteController@buscarRestaurantesMasivo');


//rutas de administracion
Route::group(['prefix' => 'administracion'], function () {
    Route::get('ingresar', 'AdminController@ingresar')->name('admin.ingresar');
    Route::get('userspendientes', 'AdminController@usersPendientes')->name('admin.pendientes');
    Route::post('aprobarempresa', 'AdminController@aprobarEmpresa')->name('admin.aprobar');
});






//rutas portal empresas
Route::get('/empresas/{id_restaurante}', 'PeticionesEmpresaController@show');
Route::post('/empresas/send', 'PeticionesEmpresaController@save');
