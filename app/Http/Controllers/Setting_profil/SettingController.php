<?php

namespace App\Http\Controllers\Setting_profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingController extends Controller
{


    public function setting()
    {
        $user = Auth::user();
        return view('freelancer.settings.setting', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:1000',
            'password' => 'nullable|min:6',
            'role' => 'required|in:freelancer,client,admin',
            'profile_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_foto')) {
            $file = $request->file('profile_foto'); // ✅ здесь корректное обращение
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('resources/uploads'), $fileName);
            $user->profile_foto = $fileName;
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? null;
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Настройки успешно обновлены!');
    }
}
