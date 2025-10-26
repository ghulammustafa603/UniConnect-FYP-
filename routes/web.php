<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NetworkingController;
use App\Http\Controllers\ChatbotController;

// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// University routes
Route::get('/universities', [UniversityController::class, 'index'])->name('universities.index');
Route::get('/universities/{university}', [UniversityController::class, 'show'])->name('universities.show');
Route::get('/universities/search', [UniversityController::class, 'search'])->name('universities.search');

// Scholarship routes
Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/scholarships/{scholarship}', [ScholarshipController::class, 'show'])->name('scholarships.show');
Route::get('/scholarships/search', [ScholarshipController::class, 'search'])->name('scholarships.search');
Route::get('/scholarships/eligibility-check', [ScholarshipController::class, 'eligibilityCheck'])->name('scholarships.eligibility-check');

// Dashboard route (redirect to home for now)
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Networking routes
    Route::get('/networking', [NetworkingController::class, 'index'])->name('networking.index');
    Route::get('/networking/create', [NetworkingController::class, 'create'])->name('networking.create');
    Route::post('/networking', [NetworkingController::class, 'store'])->name('networking.store');
    Route::get('/networking/{post}', [NetworkingController::class, 'show'])->name('networking.show');
    Route::get('/networking/{post}/edit', [NetworkingController::class, 'edit'])->name('networking.edit');
    Route::put('/networking/{post}', [NetworkingController::class, 'update'])->name('networking.update');
    Route::delete('/networking/{post}', [NetworkingController::class, 'destroy'])->name('networking.destroy');
});

// Chatbot routes
Route::post('/chatbot/message', [ChatbotController::class, 'sendMessage'])->name('chatbot.message');
Route::get('/chatbot/languages', [ChatbotController::class, 'getLanguages'])->name('chatbot.languages');

require __DIR__.'/auth.php';
