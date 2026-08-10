<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Public Web Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/nosotros', [HomeController::class, 'nosotros'])->name('nosotros');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::get('/producto/{slug}', [HomeController::class, 'detalleProducto'])->name('producto.detalle');

// Forms submit
Route::post('/solicitar-cotizacion', [HomeController::class, 'enviar'])->name('cotizacion.enviar');
Route::post('/contacto/enviar', [HomeController::class, 'enviarContacto'])->name('contacto.enviar');
Route::post('/reclamo', [HomeController::class, 'correoReclamo'])->name('reclamo.enviar');

// Catalog Shop
Route::get('/tienda', [ShopController::class, 'index'])->name('tienda');
Route::get('/tienda/productos', [ShopController::class, 'productos'])->name('tienda.productos');

// reclamaciones & terms
Route::get('/libro-de-reclamaciones', [HomeController::class, 'libroReclamaciones'])->name('libro-reclamaciones');
Route::get('/terminos-y-condiciones', [HomeController::class, 'terminos'])->name('terminos');
Route::get('/politicas-de-privacidad', [HomeController::class, 'politicas'])->name('politicas');

