@extends('layouts.app')

@section('content')

    {{-- Секція логіну з відеофоном на весь екран --}}
    <section class="relative w-full overflow-hidden" style="height: calc(100vh - 0px); margin-top: -4.5rem;">

        {{-- Фонове відео --}}
        <video
            autoplay
            muted
            loop
            playsinline
            class="absolute inset-0 w-full h-full object-cover"
            style="object-position: center center;">

            <source src="/videos/coverr-a-road-through-the-hills-6377-1080p.mp4" type="video/mp4">
            <source src="/videos/coverr-a-road-through-the-hills-6377-1080p.webm" type="video/webm">
            Ваш браузер не підтримує HTML5 відео.
        </video>

        {{-- Затемнення поверх відео --}}
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.55) 50%, rgba(0,0,0,0.75) 100%);"></div>

        {{-- Контейнер форми --}}
        <div class="relative z-10 flex items-center justify-center h-full px-4" style="padding-top: 4.5rem;">

            {{-- Карточка логіну --}}
            <div class="login-card w-full" style="max-width: 440px;">

                {{-- Іконка / логотип --}}
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4"
                         style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.25); backdrop-filter: blur(10px);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                        </svg>
                    </div>
                    <h2 class="text-4xl font-light text-white tracking-wide" style="font-family: 'Georgia', serif; letter-spacing: 0.05em;">
                        Вхід до акаунту
                    </h2>
                    <p class="text-sm mt-2" style="color: rgba(255,255,255,0.55); letter-spacing: 0.1em; text-transform: uppercase; font-size: 0.7rem;">
                        Ласкаво просимо назад
                    </p>
                </div>

                {{-- Форма --}}
                <div style="background: rgba(10,10,10,0.55); backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.12); border-radius: 20px; padding: 2.5rem;">

                    {{-- Повідомлення якщо прийшли з checkout --}}
                    @if(session('url.intended') && str_contains(session('url.intended'), 'checkout'))
                        <div class="mb-5 px-4 py-3 rounded-lg flex items-center gap-3"
                             style="background: rgba(234,179,8,0.1); border: 1px solid rgba(234,179,8,0.25);">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #fbbf24;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm" style="color: #fbbf24;">
                                Щоб оформити замовлення, необхідно увійти до акаунту
                            </p>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-5">
                            <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.5); letter-spacing: 0.12em; text-transform: uppercase;">
                                Електронна пошта
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.35);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="your@email.com"
                                    required
                                    class="login-input w-full pl-11 pr-4 py-3 text-white"
                                    style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s ease;">
                            </div>
                            @error('email')
                            <p class="mt-1 text-xs" style="color: #f87171;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Пароль --}}
                        <div class="mb-7">
                            <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.5); letter-spacing: 0.12em; text-transform: uppercase;">
                                Пароль
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.35);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input
                                    type="password"
                                    name="password"
                                    placeholder="••••••••"
                                    required
                                    class="login-input w-full pl-11 pr-4 py-3 text-white"
                                    style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s ease;">
                            </div>
                            @error('password')
                            <p class="mt-1 text-xs" style="color: #f87171;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Remember me + Забув пароль --}}
                        <div class="flex items-center justify-between mb-7">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="remember" class="w-4 h-4 rounded" style="accent-color: #3b82f6;">
                                <span class="text-sm" style="color: rgba(255,255,255,0.55);">Запам'ятати мене</span>
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-sm transition-colors"
                                   style="color: rgba(255,255,255,0.55);"
                                   onmouseover="this.style.color='#60a5fa'"
                                   onmouseout="this.style.color='rgba(255,255,255,0.55)'">
                                    Забули пароль?
                                </a>
                            @endif
                        </div>

                        {{-- Кнопка входу --}}
                        <button
                            type="submit"
                            class="login-btn w-full py-3 text-white font-medium text-sm tracking-widest"
                            style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); border: none; border-radius: 10px; cursor: pointer; letter-spacing: 0.1em; text-transform: uppercase; font-size: 0.8rem; transition: all 0.3s ease; position: relative; overflow: hidden;">
                            Увійти
                        </button>

                    </form>

                    {{-- Роздільник --}}
                    <div class="flex items-center my-6">
                        <div class="flex-1" style="height: 1px; background: rgba(255,255,255,0.1);"></div>
                        <span class="mx-4 text-xs" style="color: rgba(255,255,255,0.3);">або</span>
                        <div class="flex-1" style="height: 1px; background: rgba(255,255,255,0.1);"></div>
                    </div>

                    {{-- Посилання на реєстрацію --}}
                    <p class="text-center text-sm" style="color: rgba(255,255,255,0.45);">
                        Ще немає акаунту?
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               style="color: #60a5fa; font-weight: 500;"
                               onmouseover="this.style.color='#93c5fd'"
                               onmouseout="this.style.color='#60a5fa'">
                                Зареєструватися
                            </a>
                        @endif
                    </p>

                </div>

            </div>
        </div>
    </section>

@endsection
@push('styles')
    <style>
        .login-input::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }
        .login-input:focus {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: rgba(96, 165, 250, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .login-btn:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.45);
        }
        .login-btn:active {
            transform: translateY(0);
        }
        .login-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
        }
        .login-btn:hover::after {
            width: 300px;
            height: 300px;
        }

        /* Анімація появи карточки */
        .login-card {
            animation: fadeSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
