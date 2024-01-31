<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});


Route::post('/login-unique-private', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::get('/login-unique-private', [App\Http\Controllers\HomeController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// FAZER

// NOVIDADES{
//      CORRIGIR O FRONT "TEXTO" O TEXTO ESTÁ MUITO GRANDE
//      ORDERNAR PRODUTOS PARA TRAZER OS NOVOS
//      FAZER FILTROS LATERAL E FINALIZAR MENU
//      BANNER
//      FILTRO SUPERIOR - 
//      ORDER BY - OK
//      ITEM NOVO - OK
//      PAGINATE - OK
//      CAIXA DE SUGESTÃO
// }





Route::get('/get-products', [App\Http\Controllers\ItemsController::class, 'getProducts']);
Route::get('/get-column-product', [App\Http\Controllers\ItemsController::class, 'getColumnProduct']);
Route::get('/get-column-product-id', [App\Http\Controllers\ItemsController::class, 'getColumnProductId']);


Route::middleware(['auth'])->group(function () {

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

    Route::post('/create-product', [App\Http\Controllers\ItemsController::class, 'createProduct'])->name('admin');
    Route::post('/edit-product', [App\Http\Controllers\ItemsController::class, 'editProduct'])->name('admin');
    Route::get('/get-type-product', [App\Http\Controllers\ItemsController::class, 'getTypeProduct'])->name('admin');

});