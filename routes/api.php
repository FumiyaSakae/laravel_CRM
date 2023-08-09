<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Hr;
use App\Models\Customer;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/searchHrs', function (Request $request) {
    return Hr::searchHrs($request->search)
    ->select('id', 'name','min_price')->get();
});

Route::middleware('auth:sanctum')->get('/searchCustomers', function (Request $request) {
    return Customer::searchCustomers($request->search)
    ->select('id', 'company_name','pic_name', 'pic_kana', 'tel')->paginate(50);
});
