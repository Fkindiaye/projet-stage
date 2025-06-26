<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OcrTextController;
use App\Http\Controllers\PHPMailerController;
use App\Http\Controllers\DocumentDetailsController;

// Routes Authentification
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Accueil
Route::get('/accueil', function () {
    return view('accueil');
})->middleware('auth')->name('accueil');

// Documents
Route::middleware(['auth'])->group(function () {
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::put('/documents/{document}/restore', [DocumentController::class, 'restore'])->name('documents.restore');
});

// Autres vues protégées
Route::get('/archives', [DocumentController::class, 'archives'])->name('archives')->middleware('auth');
Route::match(['post', 'patch'], '/documents/{id}/archive', [DocumentController::class, 'archive'])->name('documents.archive');
Route::put('/documents/{id}/restore', [DocumentController::class, 'restore'])->name('documents.restore');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [UserController::class, 'showProfile'])->name('profil');
    Route::put('/profil', [UserController::class, 'updateProfile'])->name('profil.update');
});
Route::resource('users', UserController::class);

Route::get('/parametres', [SettingController::class, 'index'])->name('parametres');
Route::put('/parametres', [SettingController::class, 'update'])->name('settings.update');


Route::middleware(['auth'])->group(function () {
    
  
    Route::view('/déconnexion', 'déconnexion')->name('déconnexion');
   
});

Route::post('/ocr/save', [OcrTextController::class, 'store'])->name('ocr.save');
Route::post('/documents/partager', [DocumentController::class, 'partager'])->name('documents.partager');

Route::get('/test-phpmailer', [PHPMailerController::class, 'send']);

Route::get('/documents/{id}/details', [DocumentController::class, 'getDetails'])->name('documents.details');
// ou pour plusieurs documents
Route::post('/documents/details', [DocumentController::class, 'getMultipleDetails'])->name('documents.multiple-details');