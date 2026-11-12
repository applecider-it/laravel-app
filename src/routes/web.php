<?php

/**
 * Webのルート
 * 
 * 認証系はauth.phpにある
 */

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppliController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetJsController;
use App\Http\Controllers\TweetRailsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ChatEchoController;
use App\Http\Controllers\DevelopmentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // 認証必須

    // プロファイル
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tweet
    Route::resource('tweet', TweetController::class)->only([
        'index',
        'create',
        'store',
    ]);

    // Tweet JS
    Route::resource('/tweet_js', TweetJsController::class)->only([
        'index',
        'store',
    ]);

    // Tweet Rails
    Route::resource('tweet_rails', TweetRailsController::class)->only([
        'index',
        'create',
        'store',
    ]);

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send']);

    // Chat (Echo)
    Route::get('/chat_echo', [ChatEchoController::class, 'index'])->name('chat_echo.index');
    Route::post('/chat-echo/send', [ChatEchoController::class, 'send']);
});

// PWAマニフェスト
Route::get('/manifest.json', [AppliController::class, 'manifest']);

// アプリ
Route::get('/appli/start', [AppliController::class, 'start'])->name('appli.start');

// 開発者向けページ
Route::get('/development/index', [DevelopmentController::class, 'index'])->name('development.index');
Route::get('/development/php_test', [DevelopmentController::class, 'php_test'])->name('development.php_test');
Route::get('/development/view_test', [DevelopmentController::class, 'view_test'])->name('development.view_test');
Route::post('/development/view_test_post', [DevelopmentController::class, 'view_test_post'])->name('development.view_test_post');
Route::get('/development/javascript_test', [DevelopmentController::class, 'javascript_test'])->name('development.javascript_test');
Route::post('/development/slow_job_start', [DevelopmentController::class, 'slow_job_start']);
Route::post('/development/slow_job_progress', [DevelopmentController::class, 'slow_job_progress']);
Route::post('/development/slow_job_clear', [DevelopmentController::class, 'slow_job_clear']);
Route::post('/development/upload_test', [DevelopmentController::class, 'upload_test'])->name('development.upload_test');
Route::get('/development/router_test', [DevelopmentController::class, 'router_test'])->name('development.router_test');
Route::get('/development/ai_test', [DevelopmentController::class, 'ai_test'])->name('development.ai_test');
Route::post('/development/ai_test', [DevelopmentController::class, 'ai_test_post'])->name('development.ai_test_post');
Route::get('/development/security', [DevelopmentController::class, 'security'])
    ->name('development.security')
    ->middleware(['auth', 'password.confirm']);
Route::get('/development/verified', [DevelopmentController::class, 'verified'])
    ->name('development.verified')
    ->middleware(['auth', 'verified']);
Route::get('/development/mail_test', [DevelopmentController::class, 'mail_test'])
    ->name('development.mail_test')
    ->middleware(['auth']);

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/admin_auth.php';
