<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/institucional');
});
Route::get('/sesion', function () {
    return view('auth/login');
});



Route:: resource('almacen/categoria','CategoriaController');
Route:: resource('almacen/articulo','ArticuloController');
//Route:: resource('ventas/cliente','ClienteController');
Route:: resource('compras/proveedor','ProveedorController');
Route:: resource('compras/tecnico','VerdtecnicoController');

Route:: resource('compras/ingreso','IngresoController');
//Route:: resource('ventas/venta','VentaController');
Route:: resource('seguridad/usuario','UsuarioController');
//Route:: resource('reportes/listadoproveedores','UsuarioController');
Route:: resource('compras/ranking','RankingController');
Route::get('ingreso-list-pdf', 'IngresoController@exportPdf')->name('ingresos.pdf');


// rutas de eliminacion

Route::delete('compras/tecnico','VerdtecnicoController@destroy');
Route::delete('compras/proveedor','ProveedorController@destroy');
Route::delete('compras/ingreso','IngresoController@destroy');
Route::delete('almacen/categoria','CategoriaController@destroy ');
Route::delete('almacen/articulo','CategoriaController@destroy ');

//rutas para exportar documentos

Route::get('articulos-list-excel', 'ArticuloController@exportExcel')->name('articulos.excel');
Route::get('tecnicos-list-excel', 'VerdtecnicoController@exportExcel')->name('tecnicos.excel');
Route::get('proveedores-list-excel', 'ProveedorController@exportExcel')->name('proveedores.excel');


Route::get('reportes/listadeprooverdores', function () {
    $pdf=PDF::loadHtml('
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="table responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Nombre</th>
                        <th>Tipo Doc.</th>
                        <th>Numero de Doc.</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Puntuacion</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>'


                );
    return $pdf->stream();

});



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout','Auth\LoginController@logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');