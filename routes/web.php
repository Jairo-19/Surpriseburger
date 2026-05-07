<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ResenasController;


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReservaController;
use App\Http\Controllers\AdminPlatoController;
use App\Http\Controllers\AdminPedidoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\MiPerfilController;
use App\Http\Controllers\MisComentatiosController;
use App\Http\Controllers\MisPedidosController;
use App\Http\Controllers\MisRecompensasController;
use App\Http\Controllers\MisReservasController;

/*
|--------------------------------------------------------------------------
| Rutas Web - Surprise Burger
|--------------------------------------------------------------------------
| Aquí se registran todas las rutas HTTP de la aplicación web.
| Las rutas públicas están disponibles para cualquier visitante.
| Las rutas protegidas requieren autenticación (middleware 'auth').
| Las rutas de administración requieren además el middleware 'admin.auth'.
*/

// ======================================================
// RUTAS PÚBLICAS (sin autenticación)
// ======================================================

// Página de inicio del restaurante
Route::get('/', HomeController::class)->name('home');

// Página estática "¿Quiénes somos?"
Route::view('/quienes_somos', 'pagina.quienes_somos.quienes_somos')->name('quienes_somos');

// Menú: listado y filtrado por categoría
Route::get("/menu", [MenuController::class, "index"])->name("menu.index");
Route::get("/menu/{categoria}", [MenuController::class, "show"])->name("menu.show");

// Reseñas: ver todas (público) y crear (requiere auth)
Route::get('/resenas', [ResenasController::class, 'index'])->name('resenas.index');
Route::post('/resenas/store', [ResenasController::class, 'store'])->name('resenas.store')->middleware('auth');

// ======================================================
// RUTAS PROTEGIDAS (requieren estar autenticado)
// ======================================================
Route::middleware('auth')->group(function () {

    // Formulario y procesamiento de reservas de mesa
    Route::get("/reserva", [ReservaController::class, "index"])->name('reserva.index');
    Route::post("/reserva/store", [ReservaController::class, "store"])->name('reserva.store');

    // Perfil del usuario autenticado
    Route::get('/perfil', [MiPerfilController::class, 'index'])->name('perfil');

    // Historial de reservas del usuario
    Route::get('/mis/reservas', [MisReservasController::class, 'index'])->name('mis_reservas.index');

    // Carrito e historial de pedidos del usuario
    Route::get('/mis/pedidos', [MisPedidosController::class, 'index'])->name('mis_pedidos.index');

    // Sistema de puntos y cupones canjeables
    Route::get('/mis/recompensas', [MisRecompensasController::class, 'index'])->name('mis_recompensas.index');

    // Reseñas escritas por el usuario
    Route::get('/mis/comentarios', [MisComentatiosController::class, 'index'])->name('mis_comentarios.index');

    // Rutas del carrito de compra (AJAX)
    Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/add-coupon', [App\Http\Controllers\CartController::class, 'addCoupon'])->name('cart.addCoupon');
    Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

    // Proceso de pago del pedido
    Route::get('/pago', [App\Http\Controllers\PagoController::class, 'index'])->name('pago.index');
    Route::post('/pago/store', [App\Http\Controllers\PagoController::class, 'store'])->name('pago.store');
});



// ======================================================
// RUTAS DEL PANEL DE ADMINISTRACIÓN
// Requieren auth + middleware de rol administrador
// ======================================================
Route::middleware(['auth', 'admin.auth'])->group(function () {

    // Panel principal de administración (estadísticas y pestañas)
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Gestión de platos del menú
    Route::get('/admin/platos/index', [AdminPlatoController::class, 'index'])->name('admin_platos.index');
    Route::get('/admin/platos/create', [AdminPlatoController::class, 'create'])->name('admin_platos.create');
    Route::post("/admin/platos/store", [AdminPlatoController::class, "store"])->name("admin_platos.store");
    Route::get('/admin/platos/{id}/edit', [AdminPlatoController::class, 'edit'])->name('admin_platos.edit');
    Route::put('/admin/platos/{id}/update', [AdminPlatoController::class, 'update'])->name('admin_platos.update');
    Route::delete('/admin/platos/delete', [AdminPlatoController::class, 'destroy'])->name('admin_platos.delete');

    // Gestión de reservas desde el panel admin
    Route::get('/admin/reserva/create', [AdminReservaController::class, 'create'])->name('admin_reserva.create');
    Route::get('/admin/reserva/index', [AdminReservaController::class, 'index'])->name('admin_reserva.index');
    Route::get('/admin/reserva/{id}/edit', [AdminReservaController::class, 'edit'])->name('admin_reserva.edit');
    Route::post("/admin/reserva/store", [AdminReservaController::class, "store"])->name("admin_reserva.store");
    Route::delete('/admin/reserva/delete', [AdminReservaController::class, 'destroy'])->name('admin_reserva.delete');

    // Gestión de pedidos desde el panel admin
    Route::get('/admin/pedidos/create', [AdminPedidoController::class, 'create'])->name('admin_pedidos.create');
    Route::get('/admin/pedidos/index', [AdminPedidoController::class, 'index'])->name('admin_pedidos.index');
    Route::get('/admin/pedidos/{id}/edit', [AdminPedidoController::class, 'edit'])->name('admin_pedidos.edit');
    Route::put('/admin/pedidos/{id}/update', [AdminPedidoController::class, 'update'])->name('admin_pedidos.update');
    Route::post("/admin/pedidos/store", [AdminPedidoController::class, "store"])->name("admin_pedidos.store");

    // Gestión de cupones del programa de recompensas
    Route::get('/admin/cupones/create', [App\Http\Controllers\AdminCuponController::class, 'create'])->name('admin_cupones.create');
    Route::get('/admin/cupones/{id}/edit', [App\Http\Controllers\AdminCuponController::class, 'edit'])->name('admin_cupones.edit');
    Route::post('/admin/cupones/store', [App\Http\Controllers\AdminCuponController::class, 'store'])->name('admin_cupones.store');
    Route::put('/admin/cupones/{id}/update', [App\Http\Controllers\AdminCuponController::class, 'update'])->name('admin_cupones.update');
    Route::delete('/admin/cupones/delete', [App\Http\Controllers\AdminCuponController::class, 'destroy'])->name('admin_cupones.delete');
    
    // Ruta AJAX para cargar secciones del panel dinámicamente
    Route::get('/admin/section/{section}', [AdminController::class, 'getSection'])->name('admin.section');
});

// ======================================================
// RUTAS DE AUTENTICACIÓN (login/logout/registro)
// ======================================================

// Formulario de inicio de sesión (accesible sin autenticación)
Route::get('/login/index', [LoginController::class, 'index'])->name('login.index');
// Alias corto de login (usado por middleware de redirección automática)
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/login/create', [LoginController::class, 'create'])->name('login.create');
Route::post('/login/store', [LoginController::class, 'store'])->name('login.store');
// Cierre de sesión (requiere POST para seguridad CSRF)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Formulario y procesamiento del registro de nuevos usuarios
Route::get('/registro', [RegistroController::class, 'index'])->name('registro.index');
Route::post('/registro/store', [RegistroController::class, 'store'])->name('registro.store');
