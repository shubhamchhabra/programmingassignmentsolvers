<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Static Page Route
Route::get('page/{url}',[\App\Http\Controllers\ShowStaticPagesController::class, 'show'])->name('pages');

Route::get('home', function () {
    return redirect('/dashboard');
});

Route::middleware('auth')->group(function(){
    Route::get('/order', [\App\Http\Controllers\OrderController::class, 'index'])->name('order');
    Route::post('/order',[\App\Http\Controllers\OrderController::class,'store'])->name('order_submit');
});

Route::get('blog/{slug}', [\App\Http\Controllers\BlogController::class,'view'])->name('blog.view');


 Route::get('/{vue_capture?}', function () {
     return view('home');
 })->where('vue_capture', '[\/\w\.-]*')->middleware('auth');

