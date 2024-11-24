<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ShareController;
use Illuminate\Support\Facades\Route;


Route::post('/generate-short-url', [ShareController::class, 'generateShortUrl'])->name('generate.short.url');
Route::get('/s/{code}', [ShareController::class, 'redirectToPost'])->name('short.url.redirect');


Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('guest')->group(function () {
    Route::get('/news', function () { $posts = \App\Models\Post::latest()->get(); $postsGroupedByCategory = $posts->groupBy('category');
        return view('news', compact('posts', 'postsGroupedByCategory')); })->name('news');
        
    Route::get('/posts/{post}', [NewsController::class, 'show'])->name('posts.show');
});



Route::get('/article', function () {
    return view('article');
})->middleware(['auth', 'verified'])->name('article');

Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/react', [PostController::class, 'toggleReaction'])->name('posts.react');
    
    Route::get('/article/{post}', [PostController::class, 'show'])->name('article');

    Route::get('/author/{user}', [AuthorController::class, 'show'])->name('author');

    Route::get('/posts/view-more', [HomeController::class, 'viewMore'])->name('posts.view-more');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
