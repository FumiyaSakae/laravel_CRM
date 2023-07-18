<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HrController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PurchaseController;

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

// 顧客管理ルーティングページ
Route::resource('hrs', HrController::class)->middleware(['auth', 'verified']);
Route::resource('customers', CustomerController::class)->middleware(['auth', 'verified']);
Route::resource('purchases', PurchaseController::class)->middleware(['auth', 'verified']);

// Practiceルーティングページ
Route::get('/Top', function () {
    return Inertia::render('TopPage');
    }
);

Route::get('/Top/index',[PageController::class, 'index'])->name('topPage.index');
Route::get('/Top/create',[PageController::class, 'create'])->name('topPage.create');
Route::post('/Top',[PageController::class, 'store'])->name('topPage.store');
Route::get('/Top/show/{id}',[PageController::class, 'show'])->name('topPage.show');
Route::delete('/Top/{id}',[PageController::class, 'delete'])->name('topPage.delete');

Route::get('/component-test', function () {
    return Inertia::render('ComponentTest');
    }
);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
