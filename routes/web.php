<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AsignarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotorizadoController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\DistritosController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\RecojoController;
use App\Http\Controllers\PagoController;

// use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//  DB::listen(function($query){
//      dump($query->sql);
//  });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/pedido', [PedidoController::class, 'index'])->name('pedido.index');
    Route::get('/pedido/create', [PedidoController::class, 'create'])->name('pedido.create');
    Route::post('/pedido/store', [PedidoController::class, 'store'])->name('pedido.store');
    Route::get('/pedido/{pedido}/edit', [PedidoController::class, 'edit'])->name('pedido.edit');
    Route::put('/pedido/{pedido}/update', [PedidoController::class, 'update'])->name('pedido.update');
    Route::put('/pedido/{pedido}/anular', [PedidoController::class, 'anular'])->name('pedido.anular');
    Route::delete('/pedido/{pedido}/destroy', [PedidoController::class, 'destroy'])->name('pedido.destroy');
    Route::get('/pedido/xcarga-masiva', [PedidoController::class, 'xcargamasiva'])->name('pedido.xcargamasiva');
    Route::post('/pedido/guardar', [PedidoController::class, 'guardar'])->name('pedido.guardar');
    Route::get('/pedido/obtenerTipoPedido', [PedidoController::class, 'obtenerTipoPedido'])->name('pedido.obtenerTipoPedido');
    Route::get('/pedido/obtenerMetodoPago', [PedidoController::class, 'obtenerMetodoPago'])->name('pedido.obtenerMetodoPago');
    Route::get('/obtenerPedidos', [PedidoController::class, 'obtenerPedidos']);
    Route::get('/obtenerPedidosNegocio/{id}', [PedidoController::class, 'obtenerPedidosNegocio']);
    Route::get('/obtenerPedido/{id}', [PedidoController::class, 'obtenerPedido']);
    Route::get('/pedido/storeMax', [PedidoController::class, 'storeMax'])->name('pedido.storeMax');
    
    Route::get('/ruta', [RutaController::class, 'index'])->name('ruta.index');
    Route::post('/ruta/asignar', [RutaController::class, 'asignar'])->name('ruta.asignar');
    Route::post('/ruta/eliminarRuta', [RutaController::class, 'eliminarRuta'])->name('ruta.eliminarRuta');
    Route::get('/ruta/asignarPedidos', [RutaController::class, 'asignarPedidos'])->name('ruta.asignarPedidos');
    Route::post('/ruta/pedidos_asignados', [RutaController::class, 'pedidos_asignados'])->name('ruta.pedidos_asignados');
    
    Route::get('/motorizado', [MotorizadoController::class, 'index'])->name('moto.index');
    Route::get('/motorizado/create', [MotorizadoController::class, 'create'])->name('moto.create');
    Route::post('/motorizado/store', [MotorizadoController::class, 'store'])->name('moto.store');
    Route::get('/motorizado/{motorizado}/edit', [MotorizadoController::class, 'edit'])->name('moto.edit');
    Route::delete('/motorizado/{motorizado}/destroy', [MotorizadoController::class, 'destroy'])->name('moto.destroy');
    Route::get('/motorizado/pedidos', [MotorizadoController::class, 'pedidos'])->name('moto.pedidos');
    Route::get('/motorizado/recojos', [MotorizadoController::class, 'recojos'])->name('moto.recojos');
    Route::get('/motorizado/devoluciones', [MotorizadoController::class, 'devoluciones'])->name('moto.devoluciones');
    Route::get('/motorizado/reportes', [MotorizadoController::class, 'reportes'])->name('moto.reportes');
    Route::post('/motorizado/entregado', [MotorizadoController::class, 'entregado'])->name('moto.entregado');
    Route::post('/motorizado/rechazado', [MotorizadoController::class, 'rechazado'])->name('moto.rechazado');
    Route::post('/motorizado/reiniciar', [MotorizadoController::class, 'reiniciar'])->name('moto.reiniciar');
    Route::post('/motorizado/incidencia', [MotorizadoController::class, 'incidencia'])->name('moto.incidencia');
    Route::post('/motorizado/intercambiar', [MotorizadoController::class, 'intercambiar'])->name('moto.intercambiar');
    Route::get('/motorizado/storeMax', [MotorizadoController::class, 'storeMax'])->name('moto.storeMax');
    
    Route::get('/coordinador/incidencias', [CoordinadorController::class, 'incidencias'])->name('coordinador.incidencias');

    Route::get('/recojo', [RecojoController::class, 'index'])->name('recojo.index');
    Route::post('/recojo/asignarRecojo', [RecojoController::class, 'asignarRecojo'])->name('recojo.asignarRecojo');
    Route::get('/pago', [PagoController::class, 'index'])->name('pago.index');
    Route::post('/pago/motorizado', [PagoController::class, 'motorizado'])->name('pago.motorizado');
    Route::get('/pago/obtenerPagos', [PagoController::class, 'obtenerPagos'])->name('pago.obtenerPagos');
    Route::get('/pago/consolidado', [PagoController::class, 'consolidado'])->name('pago.consolidado');
    
    //Route::resource('/motorizado', MotorizadoController::class)->names('moto');

    Route::resource('/profile', ProfileController::class)->names('profile');
    Route::resource('/roles', RoleController::class)->names('roles');
    Route::resource('/permisos', PermisoController::class)->names('permisos');
    Route::resource('/asignar', AsignarController::class)->names('asignar');
    Route::resource('/usuarios', UsuarioController::class)->names('usuario');
    //Route::resource('/motorizado', MotorizadoController::class)->names('moto');
    Route::resource('/negocio', NegocioController::class)->names('negocio');
    Route::resource('/mapa', MapsController::class)->names('mapa');
    Route::get('/obtenerDepartamento', [DistritosController::class, 'obtenerDepartamento']);
    Route::get('/obtenerProvincia/{id}', [DistritosController::class, 'obtenerProvincia']);
    Route::get('/obtenerDistrito/{id}', [DistritosController::class, 'obtenerDistrito']);
    // Route::get('/obtenerPedidos', [DistritosController::class, 'obtenerPedidos']);
    // Route::get('/obtenerPedido/{id}', [DistritosController::class, 'obtenerPedido']);

});

require __DIR__.'/auth.php';
