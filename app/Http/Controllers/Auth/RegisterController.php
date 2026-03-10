<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => ['required', 'string', 'unique:users,phone', 'regex:/^\+380\d{9}$/'],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required'      => "Ім'я обов'язкове",
            'email.required'     => 'Email обов\'язковий',
            'email.email'        => 'Введіть коректний email',
            'email.unique'       => 'Цей email вже зареєстрований',
            'phone.required'     => 'Номер телефону обов\'язковий',
            'phone.unique'       => 'Цей номер вже зареєстрований',
            'phone.regex'        => 'Формат: +380XXXXXXXXX',
            'password.required'  => 'Пароль обов\'язковий',
            'password.min'       => 'Пароль має бути не менше 8 символів',
            'password.confirmed' => 'Паролі не збігаються',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
