<?php
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VhodController;
use App\Http\Controllers\my_uslug\MyUslugeController;
use App\Http\Controllers\Profil\ProfilController;
use App\Http\Controllers\Index\IndexController;
use App\Http\Controllers\Birja\BirjaController;
use App\Http\Controllers\Setting_profil\SettingController;
use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', [IndexController::class, 'home'])->name('home');

// Биржа
Route::get('/birja/birja', [BirjaController::class, 'birja'])->name('birja');

// Регистрация и вход
Route::get('/auth/regist/regist', [RegisterController::class, 'regist'])->name('regist');
Route::post('/auth/regist/regist', [RegisterController::class, 'submit'])->name('regist-form');

// Профиль (доступен только авторизованным пользователям)
//Route::get('/profile/profile', [ProfilController::class, 'profile'])->name('profile')->middleware('auth');

Route::get('/auth/vhod/vhod', [VhodController::class, 'vhod'])->name('vhod');
Route::post('/auth/vhod/vhod', [VhodController::class, 'login'])->name('login');


Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/profile/profile', [ProfilController::class, 'profile'])->name('profile');

    Route::get('/freelancer/my-uslug/usluge', [MyUslugeController::class, 'usluge'])->name('usluge');

    Route::get('/freelancer/my-uslug/create', [MyUslugeController::class, 'create'])->name('services.create');
    Route::post('/freelancer/my-uslug/store', [MyUslugeController::class, 'store'])->name('services.store');
    Route::get('/freelancer/my-uslug/edit/{id}', [MyUslugeController::class, 'edit'])->name('services.edit');
    Route::put('/freelancer/my-uslug/update/{id}', [MyUslugeController::class, 'update'])->name('services.update');
    Route::delete('/freelancer/my-uslug/destroy/{id}', [MyUslugeController::class, 'destroy'])->name('services.destroy');

    Route::get('/freelancer/my-uslug/stats', [MyUslugeController::class, 'stats'])->name('my-uslug.stats');
    Route::post('/freelancer/my-uslug/usluge/{id}', [MyUslugeController::class, 'like'])->name('services.like');
    Route::post('/freelancer/services/{id}/like', [MyUslugeController::class, 'like'])->name('services.like');

    Route::get('/freelancer/setting/setting', [SettingController::class, 'setting'])->name('setting');
    Route::put('/freelancer/setting/setting', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/freelancer/setting/setting', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/lagout', function () {
        Auth::logout(); // Завершает сеанс пользователя
        return redirect('/'); // Перенаправляет на главную страницу
    })->name('lagout');
});