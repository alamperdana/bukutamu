<?php

use App\Models\Satker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/satker', function (Request $request) {
    $query = $request->get('query', '');

    $data = Satker::where('kode_satker', 'like', "%{$query}%")
        ->orWhere('name', 'like', "%{$query}%")
        ->select('kode_satker', 'name')
        ->get();

    return response()->json($data);
})->name('api.satker');