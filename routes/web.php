<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Environment\Console;
use SebastianBergmann\Environment\Runtime;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\VarDumper\VarDumper;

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

// Route::post('newsletter', function () {
//     request()->validate(['email' => 'required|email']);

//     $mailchimp =new \MailchimpMarketin\ApiClient();
//     $mailchimp->setConfig([
//         'apiKey' => config('servieces.mailchimp.key'),
//         'server' => 'us6'
//     ]);

//     $response = $mailchimp->Lists->addListMember('d3c0c95629', [
//         'email_address' => request('email'),
//         'status' => 'subcribed'
//     ]);
//     return redirect('/')->with('success', 'You are now signed up for our newsletters!');
// });

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionController::class, 'create'])->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

//admin
Route::post('admin/posts', [AdminController::class, 'store'])->middleware('admin');
Route::get('admin/posts/create', [AdminController::class, 'create'])->middleware('admin');

Route::get('admin/posts', [AdminController::class, 'index'])->middleware('admin');
Route::get('admin/posts/{post}/edit', [AdminController::class, 'edit'])->middleware('admin');
Route::patch('admin/posts/{post}', [AdminController::class, 'update'])->middleware('admin');
Route::delete('admin/posts/{post}', [AdminController::class, 'destroy'])->middleware('admin');
