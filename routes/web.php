<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductAnswersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductQuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShippingAddressController;
use Illuminate\Support\Facades\Route;

//-- MAIN --
Route::get('/', [HomeController::class, 'index'])->name('Home');

//-- PRODUCT --
Route::controller(ProductController::class)->group(function (){
    //ONLY ADMIN/OWNER
    Route::middleware(['auth', 'active', 'role:admin,owner'])->group(function () {
        Route::post ('/Producto', 'store');
        Route::get  ('/Producto/Registrar', 'create')->name('product.create');;
        Route::patch('/Producto/{product}/Actualizar', 'update');
        Route::patch('/Producto/{product}/Estado', 'toggleEnable');
        Route::get  ('/Producto/{id}/Editar', 'edit');
    });

    Route::get  ('/Producto/{id}', 'show')->name('products.show');
    Route::get  ('/Productos/{category?}', 'index')->name('products.index');
});

//-- PRODUCT QUESTION --
Route::controller(ProductQuestionController::class)->group(function (){
    Route::middleware(['auth', 'active'])->group(function () {
        Route::post ('/Preguntar/{product}', 'store')->middleware(['role:customer']);
        Route::patch('/Preguntar/{question}/Eliminar', 'toggleEnable');
    });
});

//-- QUESTION ANSWER --
Route::controller(ProductAnswersController::class)->group(function (){
    Route::post ('/Responder/{question}', 'store')->middleware(['auth', 'active']);
});

//-- PROFILE --
Route::middleware('auth')->group(function () {
    Route::get('/Perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/Perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/Perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['active', 'role:admin,owner'])->group(function () {
        Route::get('/Usuarios', [ProfileController::class, 'index'])->name('profile.index');
    });

    Route::middleware(['active', 'role:owner'])->group(function () {
        Route::patch('/Perfil/RoleSwap/{user}', [ProfileController::class, 'roleswap'])->name('profile.roleswap');
    });
});

//-- SHIPPING ADDRESS --
Route::middleware('auth')->group(function () {
    Route::patch('/Direccion/{address}/Estado', [ShippingAddressController::class,'toggleEnable']);
    Route::patch('/Direccion/{address}/Actualizar', [ShippingAddressController::class, 'update']);
    Route::get  ('/Direccion', [ShippingAddressController::class, 'create'])->name('address.create');
    Route::post ('/Direccion', [ShippingAddressController::class, 'store'])->name('address.store');
});

//-- CART --
Route::middleware('auth')->group(function () {
    Route::get  ('/Carrito', [CartController::class, 'index'])->name('cart.index');
    Route::post ('/Carrito/Agregar', [CartController::class, 'addCartItem'])->name('cart.addCartItem');
    Route::patch('/Carrito/Modificar', [CartController::class, 'updateItemQuantity'])->name('cart.updateItemQuantity');
    Route::patch('/Carrito/Quitar', [CartController::class, 'removeCartItem'])->name('cart.removeCartItem');
    Route::patch('/Carrito/ModificarDireccion', [CartController::class, 'updatePreferredAddress'])->name('cart.updatePreferredAddress');
});

//-- ORDER --
Route::middleware('auth')->group(function () {
    Route::get  ('/Ordenes', [OrderController::class, 'index'])->name('order.index');
    Route::post ('/GenerarOrden', [OrderController::class, 'store'])->name('order.store');
    
    Route::post ('/Orden/{order}', [OrderController::class, 'show'])->name('order.show');
});

require __DIR__.'/auth.php';
