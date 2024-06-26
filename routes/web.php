<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientRequestWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use App\Models\Post;
use Illuminate\Http\Request;

// Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/client/samirbaha/driss/123', [ClientRequestWebController::class, 'getClientRequests'])->name('getClientRequests');
    Route::get('/client/{clientId}', [ClientRequestWebController::class, 'getClientDetails'])->name('client.details');
    Route::get('/client', [ClientRequestWebController::class, 'getClientRequests'])->name('getClientRequests');
    Route::put('/client-request/{requestId}/toggle-status', [ClientRequestWebController::class, 'toggleStatus']);
    Route::delete('/client-request/{requestId}/delete-solution/{solutionIndex}', [ClientRequestWebController::class, 'deleteSolution'])->name('client-request.delete-solution');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/posts/index', [PostController::class, 'getPosts'])->name('admin.posts.index');
});

// Artisan and storage routes
Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/linkstorage', function () {
    $targetFolder = base_path().'/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
    symlink($targetFolder, $linkFolder);
});

// PDF download route
Route::get('pdfs/{filename}', function ($filename) {
    $file = Storage::get('pdfs/' . $filename);
    return response($file, 200)->header('Content-Type', 'application/pdf');
})->name('pdf.download');

// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
