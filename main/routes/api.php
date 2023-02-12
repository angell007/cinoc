<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('delete-training', function (Request $request) {
    return response()->json(DB::table('trainings')->where('id', request()->get('data')['trainings_id'])->delete());
})->name('delete-training');


Route::get('proffesions', function (Request $request) {

    if (request()->get('name')) {
        $array = DB::table('professions')->where('name', request()->get('name'))->first(['name as id', 'name as text']);
        return response()->json($array);
    }

    $array = DB::table('professions')->where('name', 'Like', '%' . request()->get('q') . '%')->limit(10)->get(['name as id', 'name as text'])->toArray();
    return response()->json(['results' => $array]);
});
