<?php

namespace App\Http\Controllers\Setting_profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingController extends Controller
{
    // Отображение страницы настроек
    public function setting()
    {
        $user = Auth::user();
        return view('freelancer.settings.setting', compact('user'));
    }

    // Обработка сохранения изменений
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'aboutUser' => 'nullable|string|max:1000',
            'password' => 'nullable|min:6',
            'role' => 'required|in:freelancer,client,admin',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $fileName = uniqid() . '_' . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('resources/uploads'), $fileName);
            $user->profile_foto = $fileName;
        }

        // Правильные названия полей
        $user->name = $validated['fullName'];
        $user->email = $validated['email'];
        $user->bio = $validated['aboutUser'] ?? null;
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Настройки успешно обновлены!');
    }
}
