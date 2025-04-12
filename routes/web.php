<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Index\IndexController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VhodController;
use App\Http\Controllers\Profil\ProfilController;
use App\Http\Controllers\Birja\BirjaController;
use App\Http\Controllers\Client\ClientContriller;
use App\Http\Controllers\Setting_profil\SettingController;
use App\Http\Controllers\my_uslug\MyUslugeController;

/*
|--------------------------------------------------------------------------
| Гостевые маршруты (для всех пользователей)
|--------------------------------------------------------------------------
*/

// Главная страница
Route::get('/', [IndexController::class, 'home'])->name('home');

// Биржа
Route::get('/birja/birja', [BirjaController::class, 'birja'])->name('birja');

// Регистрация
Route::get('/auth/regist/regist', [RegisterController::class, 'regist'])->name('regist');
Route::post('/auth/regist/regist', [RegisterController::class, 'submit'])->name('regist-form');

// Авторизация
Route::get('/auth/vhod/vhod', [VhodController::class, 'vhod'])->name('vhod');
Route::post('/auth/vhod/vhod', [VhodController::class, 'login'])->name('login');


/*
|--------------------------------------------------------------------------
| Маршруты для авторизованных пользователей
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'auth.session'])->group(function () {

    // Профиль
    Route::get('/profile/profile', [ProfilController::class, 'profile'])->name('profile');

    // Услуги фрилансера
    Route::prefix('freelancer/my-uslug')->group(function () {
        Route::get('/usluge', [MyUslugeController::class, 'usluge'])->name('usluge');
        Route::get('/create', [MyUslugeController::class, 'create'])->name('services.create');
        Route::post('/store', [MyUslugeController::class, 'store'])->name('services.store');
        Route::get('/edit/{id}', [MyUslugeController::class, 'edit'])->name('services.edit');
        Route::put('/update/{id}', [MyUslugeController::class, 'update'])->name('services.update');
        Route::delete('/destroy/{id}', [MyUslugeController::class, 'destroy'])->name('services.destroy');
        Route::get('/stats', [MyUslugeController::class, 'stats'])->name('my-uslug.stats');
        Route::post('/usluge/{id}', [MyUslugeController::class, 'like'])->name('services.like');
    });

    // Отдельный лайк маршрут (возможно дублируется)
    Route::post('/freelancer/services/{id}/like', [MyUslugeController::class, 'like'])->name('services.like');

    // Настройки профиля
    Route::get('/freelancer/setting/setting', [SettingController::class, 'setting'])->name('setting');
    Route::put('/freelancer/setting/setting', [SettingController::class, 'update'])->name('settings.update');
    Route::post('/freelancer/setting/setting', [SettingController::class, 'update'])->name('settings.update');

    // Просмотр услуги
    Route::get('/services/{id}', [MyUslugeController::class, 'show'])->name('services.show');

    // Страница исполнителей (видит клиент)
    Route::get('/client/work/client', [ClientContriller::class, 'client'])->name('client.work.client');

    // Отклик на фрилансера
    Route::get('/respond/{id}', [ClientContriller::class, 'respond'])->name('respond.to.freelancer');

    // Выход
    Route::get('/lagout', function () {
        Auth::logout();
        return redirect('/');
    })->name('lagout');
});

/*
|--------------------------------------------------------------------------
| Маршруты для авторизованных admin
|--------------------------------------------------------------------------
*/

Route::get('/admin', [AdminController::class, 'index'])->middleware('can:isAdmin')->name('admin.dashboard');
