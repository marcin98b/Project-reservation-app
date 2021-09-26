<?php

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
    return view('home');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/topics', [App\Http\Controllers\TopicController::class, 'index'])->name('topic');
Route::get('/topics/myproject', [App\Http\Controllers\TopicController::class, 'myproject'])->name('topicMyProject');
Route::post('/topics/myproject', [App\Http\Controllers\TopicController::class, 'chooseAnother'])->name('topicChooseAnother');
Route::get('/topics/myproject/upload', [App\Http\Controllers\FileUploadController::class, 'show'])->name('uploadShow');
Route::post('/topics/myproject/upload', [App\Http\Controllers\FileUploadController::class, 'fileUpload'])->name('fileUpload');
Route::get('/topics/create', [App\Http\Controllers\TopicController::class, 'create'])->name('topicCreate');
Route::post('/topics/create', [App\Http\Controllers\TopicController::class, 'store'])->name('topicStore');
Route::post('/topics/choose', [App\Http\Controllers\TopicController::class, 'choose'])->name('topicChoose');
Route::get('/topics/{id}/edit', [App\Http\Controllers\TopicController::class, 'edit'])->name('topicEdit');
Route::put('/topics/{id}/edit', [App\Http\Controllers\TopicController::class, 'update'])->name('topicUpdate');
Route::get('/topics/{id}', [App\Http\Controllers\TopicController::class, 'show'])->name('topicShow');
Route::delete('/topics/{id}', [App\Http\Controllers\TopicController::class, 'destroy'])->name('topicDestroy');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::post('/dashboard', [App\Http\Controllers\MarkController::class, 'markAssign'])->name('markAssign');
Route::get('/dashboard/exportJSON', [App\Http\Controllers\HomeController::class, 'exportJSON'])->name('exportJSON');


