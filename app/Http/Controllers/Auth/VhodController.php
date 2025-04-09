<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VhodController extends Controller
{
    public function vhod(Request $request){
         // Выполняем logout
         if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return view('auth.vhod.vhod');
    }

    public function login(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Попытка авторизации
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember'); // Проверяем наличие ключа "remember"
    
        if (Auth::attempt($credentials, $remember)) {
            // Успешная авторизация
            $request->session()->regenerate(); // Обновляем сессию
            return redirect()->intended(route('profile')); // Перенаправляем пользователя
        }
    
        // Неудачная авторизация
        return back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ])->onlyInput('email');
    }
    
}
