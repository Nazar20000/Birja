<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistRequest; // Подключаем класс валидации
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Отображение страницы регистрации.
     */
    public function regist(Request $request)
    {
        // Выполняем logout
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return view('auth.regist.regist');
    }


    /**
     * Обработка данных регистрации.
     */
    public function submit(RegistRequest $request)
    {

        // Загрузка изображения профиля (если есть)
        $profileFoto = null;
        if ($request->hasFile('profile_foto')) {
            $file = $request->file('profile_foto');
            $fileName = uniqid() . '_' . $file->getClientOriginalName(); // Генерация уникального имени файла
            $file->move(public_path('resources/uploads'), $fileName); // Сохраняем файл в папку public/uploads
            $profileFoto = $fileName; // Путь для хранения в базе данных
        }

    
        // Создание пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Хэшируем пароль
            'role' => $request->role, // Убедитесь, что поле 'role' есть в модели User
            'profile_foto' => $profileFoto,
            'many' => $request->many, // Дополнительные данные
        ]);
    
        // Авторизация пользователя
        Auth::login($user);
    
        // Редирект на профиль
        return redirect()->route('profile'); // Без необходимости указывать middleware
    }
    

}
