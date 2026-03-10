<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => ['nullable', 'string', 'regex:/^\+380\d{9}$/', 'unique:users,phone,' . $user->id],
        ], [
            'name.required'  => "Ім'я обов'язкове",
            'email.required' => 'Email обов\'язковий',
            'email.email'    => 'Введіть коректний email',
            'email.unique'   => 'Цей email вже використовується',
            'phone.regex'    => 'Формат: +380XXXXXXXXX',
            'phone.unique'   => 'Цей номер вже використовується',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Профіль успішно оновлено!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Введіть поточний пароль',
            'password.required'         => 'Введіть новий пароль',
            'password.min'              => 'Пароль має бути не менше 8 символів',
            'password.confirmed'        => 'Паролі не збігаються',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Поточний пароль невірний'])->withInput();
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success_password', 'Пароль успішно змінено!');
    }
}
