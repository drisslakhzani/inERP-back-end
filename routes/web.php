<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientRequestWebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Storage;


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
    Route::get('/posts', [PostController::class, 'getPosts'])->name('admin.posts');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::get('pdfs/{filename}', function ($filename) {
    $file = Storage::get('pdfs/' . $filename);
    return response($file, 200)->header('Content-Type', 'application/pdf');
})->name('pdf.download');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');









