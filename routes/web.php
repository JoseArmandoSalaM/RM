<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/cotizaciones');

Auth::routes();


Route::middleware(['auth'])->group(function () {



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas para los trabajadores
Route::get('/works', [App\Http\Controllers\WorkController::class, 'index'])->name('works');
Route::post('/works-create', [App\Http\Controllers\WorkController::class, 'store'])->name('regist');
Route::post('/works-update/{id}', [App\Http\Controllers\WorkController::class, 'update'])->name('modificar');
Route::get('/eliminar/{id}', [App\Http\Controllers\WorkController::class, 'eliminar'])->name('eliminar');
Route::get('/buscar', [App\Http\Controllers\WorkController::class, 'buscar'])->name('buscar');


//ruta para servicios
Route::get('/servicio', [App\Http\Controllers\ServicioController::class, 'index'])->name('worksServices');
Route::post('/servicio-create', [App\Http\Controllers\ServicioController::class, 'store'])->name('registServices');
Route::post('/servicio-update/{id}', [App\Http\Controllers\ServicioController::class, 'update'])->name('modificarServices');
Route::get('/elimin/{id}', [App\Http\Controllers\ServicioController::class, 'eliminar'])->name('eliminarServices');
Route::get('/buscardor', [App\Http\Controllers\ServicioController::class, 'buscar'])->name('buscarServices');


//ruta para empresas
Route::get('/empresas', [App\Http\Controllers\EmpresaController::class, 'index'])->name('worksEmpresa');
Route::post('/empresas-create', [App\Http\Controllers\EmpresaController::class, 'store'])->name('registEmpresa');
Route::post('/empresas-update/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('modificarEmpresa');
Route::get('/eliminE/{id}', [App\Http\Controllers\EmpresaController::class, 'eliminar'])->name('eliminarEmpresa');
Route::get('/buscardorE', [App\Http\Controllers\EmpresaController::class, 'buscar'])->name('buscarEmpresa');


//Ruta para los contactos
Route::get('/contactos', [App\Http\Controllers\ContactoController::class, 'index'])->name('worksContacto');
Route::post('/contactos-create', [App\Http\Controllers\ContactoController::class, 'store'])->name('registContacto');
Route::post('/contactos-update/{id}', [App\Http\Controllers\ContactoController::class, 'update'])->name('modificarContacto');
Route::get('/eliminC/{id}', [App\Http\Controllers\ContactoController::class, 'eliminar'])->name('eliminarContacto');
Route::get('/buscardorC', [App\Http\Controllers\ContactoController::class, 'buscar'])->name('buscarContacto');


//Ruta para los productos
Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('worksProducto');
Route::post('/productos-create', [App\Http\Controllers\ProductoController::class, 'store'])->name('registProducto');
Route::post('/productos-update/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('modificarProducto');
Route::get('/eliminP/{id}', [App\Http\Controllers\ProductoController::class, 'eliminar'])->name('eliminarProducto');
Route::get('/buscardorP', [App\Http\Controllers\ProductoController::class, 'buscar'])->name('buscarProducto');


//Ruta para las herramientas
Route::get('/herramientas', [App\Http\Controllers\HerramientaController::class, 'index'])->name('worksHerramienta');
Route::post('/herramientas-create', [App\Http\Controllers\HerramientaController::class, 'store'])->name('registHerramienta');
Route::post('/herramientas-update/{id}', [App\Http\Controllers\HerramientaController::class, 'update'])->name('modificarHerramienta');
Route::get('/eliminH/{id}', [App\Http\Controllers\HerramientaController::class, 'eliminar'])->name('eliminarHerramienta');
Route::get('/buscardorH', [App\Http\Controllers\HerramientaController::class, 'buscar'])->name('buscarHerramienta');


//Ruta para las encargados
Route::get('/encargados', [App\Http\Controllers\EncargadoController::class, 'index'])->name('worksEncargado');
Route::post('/encargados-create', [App\Http\Controllers\EncargadoController::class, 'store'])->name('registEncargado');
Route::post('/encargados-update/{id}', [App\Http\Controllers\EncargadoController::class, 'update'])->name('modificarEncargado');
Route::get('/eliminEn/{id}', [App\Http\Controllers\EncargadoController::class, 'eliminar'])->name('eliminarEncargado');
Route::get('/buscardorEn', [App\Http\Controllers\EncargadoController::class, 'buscar'])->name('buscarEncargado');

//Ruta para las cotizaciones
Route::get('/cotizaciones', [App\Http\Controllers\CotizacionController::class, 'index'])->name('worksCotizacion');
Route::post('/cotizaciones-create', [App\Http\Controllers\CotizacionController::class, 'store'])->name('registCotizacion');
Route::post('/cotizaciones-update/{id}', [App\Http\Controllers\CotizacionController::class, 'update'])->name('modificarCotizacion');

//agregar mas presupuestos
Route::post('/presupuesto-update/{id}', [App\Http\Controllers\CotizacionController::class, 'presupuestoupdate'])->name('presupuestoUpdate');

// Ruta para editar una cotización
Route::get('/cotizaciones/editar/{id}', [App\Http\Controllers\CotizacionController::class, 'edit'])->name('editCotizacion');

//mostrar datos
Route::get('/cotizaciones/mostrar/{id}', [App\Http\Controllers\CotizacionController::class, 'show'])->name('showCotizacion');

Route::get('/eliminCo/{id}', [App\Http\Controllers\CotizacionController::class, 'eliminar'])->name('eliminarCotizacion');
Route::get('/buscardorCo', [App\Http\Controllers\CotizacionController::class, 'buscar'])->name('buscarCotizacion');


//pdf de la cotizacion
Route::get('/cotizacion/pdf/{id}', [App\Http\Controllers\CotizacionController::class, 'generatePDF'])->name('cotizacion.pdf');


//buttom facturar
Route::post('/cotizaciones/facturar/{id}', [App\Http\Controllers\CotizacionController::class, 'facturar'])->name('facturarCotizacion');

});
