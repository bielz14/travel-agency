@extends('layouts.app')

@section('content')

    <section class="relative w-full overflow-hidden" style="height: calc(100vh); margin-top: -4.5rem;">

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

        {{-- Затемнення --}}
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.55) 50%, rgba(0,0,0,0.75) 100%);"></div>

        {{-- Контейнер форми --}}
        <div class="relative z-10 flex items-center justify-center h-full px-4" style="padding-top: 4.5rem; overflow-y: auto;">

            <div class="register-card w-full my-8" style="max-width: 440px;">

                {{-- Іконка / логотип --}}
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4"
                         style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.25); backdrop-filter: blur(10px);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h2 class="text-4xl font-light text-white tracking-wide" style="font-family: 'Georgia', serif; letter-spacing: 0.05em;">
                        Реєстрація
                    </h2>
                    <p class="text-sm mt-2" style="color: rgba(255,255,255,0.55); letter-spacing: 0.1em; text-transform: uppercase; font-size: 0.7rem;">
                        Створіть свій акаунт
                    </p>
                </div>

                {{-- Форма --}}
                <div style="background: rgba(10,10,10,0.55); backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.12); border-radius: 20px; padding: 2.5rem;">

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        {{-- Ім'я --}}
                        <div class="mb-5">
                            <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.5); letter-spacing: 0.12em; text-transform: uppercase;">Ім'я</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.35);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ваше ім'я" required
                                       class="reg-input w-full pl-11 pr-4 py-3 text-white"
                                       style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('name') ? 'rgba(248,113,113,0.6)' : 'rgba(255,255,255,0.15)' }}; border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s ease;">
                            </div>
                            @error('name')<p class="mt-1 text-xs" style="color: #f87171;">{{ $message }}</p>@enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-5">
                            <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.5); letter-spacing: 0.12em; text-transform: uppercase;">Електронна пошта</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.35);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="your@email.com" required
                                       class="reg-input w-full pl-11 pr-4 py-3 text-white"
                                       style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('email') ? 'rgba(248,113,113,0.6)' : 'rgba(255,255,255,0.15)' }}; border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s ease;">
                            </div>
                            @error('email')<p class="mt-1 text-xs" style="color: #f87171;">{{ $message }}</p>@enderror
                        </div>

                        {{-- Телефон --}}
                        <div class="mb-5">
                            <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.5); letter-spacing: 0.12em; text-transform: uppercase;">Номер телефону</label>
                            <div class="relative">
                                {{-- Прапор України --}}
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 gap-2" style="color: rgba(255,255,255,0.35);">
                                    <span style="font-size: 1rem; line-height: 1;">🇺🇦</span>
                                </div>
                                <input
                                    type="tel"
                                    name="phone"
                                    id="phone"
                                    value="{{ old('phone', '+380') }}"
                                    placeholder="+380 XX XXX XX XX"
                                    required
                                    maxlength="17"
                                    class="reg-input w-full pl-11 pr-4 py-3 text-white"
                                    style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('phone') ? 'rgba(248,113,113,0.6)' : 'rgba(255,255,255,0.15)' }}; border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s ease; letter-spacing: 0.05em;">
                            </div>
                            @error('phone')
                            <p class="mt-1 text-xs" style="color: #f87171;">{{ $message }}</p>
                            @else
                                <p class="mt-1 text-xs" style="color: rgba(255,255,255,0.3);">Формат: +380 XX XXX XX XX</p>
                                @enderror
                        </div>

                        {{-- Пароль --}}
                        <div class="mb-5">
                            <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.5); letter-spacing: 0.12em; text-transform: uppercase;">Пароль</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.35);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input type="password" name="password" placeholder="Мінімум 8 символів" required
                                       class="reg-input w-full pl-11 pr-10 py-3 text-white"
                                       id="password"
                                       style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('password') ? 'rgba(248,113,113,0.6)' : 'rgba(255,255,255,0.15)' }}; border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s ease;">
                                {{-- Показати/Приховати пароль --}}
                                <button type="button" onclick="togglePassword('password', 'eye1')"
                                        class="absolute inset-y-0 right-0 flex items-center pr-4"
                                        style="color: rgba(255,255,255,0.35); background: none; border: none; cursor: pointer;">
                                    <svg id="eye1" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')<p class="mt-1 text-xs" style="color: #f87171;">{{ $message }}</p>@enderror
                        </div>

                        {{-- Підтвердження паролю --}}
                        <div class="mb-7">
                            <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.5); letter-spacing: 0.12em; text-transform: uppercase;">Підтвердження паролю</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.35);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <input type="password" name="password_confirmation" placeholder="Повторіть пароль" required
                                       class="reg-input w-full pl-11 pr-10 py-3 text-white"
                                       id="password_confirmation"
                                       style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.15); border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s ease;">
                                <button type="button" onclick="togglePassword('password_confirmation', 'eye2')"
                                        class="absolute inset-y-0 right-0 flex items-center pr-4"
                                        style="color: rgba(255,255,255,0.35); background: none; border: none; cursor: pointer;">
                                    <svg id="eye2" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Кнопка реєстрації --}}
                        <button type="submit" class="reg-btn w-full py-3 text-white font-medium"
                                style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); border: none; border-radius: 10px; cursor: pointer; letter-spacing: 0.1em; text-transform: uppercase; font-size: 0.8rem; transition: all 0.3s ease; position: relative; overflow: hidden;">
                            Зареєструватися
                        </button>

                    </form>

                    {{-- Роздільник --}}
                    <div class="flex items-center my-6">
                        <div class="flex-1" style="height: 1px; background: rgba(255,255,255,0.1);"></div>
                        <span class="mx-4 text-xs" style="color: rgba(255,255,255,0.3);">або</span>
                        <div class="flex-1" style="height: 1px; background: rgba(255,255,255,0.1);"></div>
                    </div>

                    <p class="text-center text-sm" style="color: rgba(255,255,255,0.45);">
                        Вже є акаунт?
                        <a href="{{ route('login') }}"
                           style="color: #60a5fa; font-weight: 500;"
                           onmouseover="this.style.color='#93c5fd'"
                           onmouseout="this.style.color='#60a5fa'">Увійти</a>
                    </p>

                </div>
            </div>
        </div>
    </section>

    <style>
        .reg-input::placeholder { color: rgba(255, 255, 255, 0.25); }
        .reg-input:focus {
            background: rgba(255, 255, 255, 0.1) !important;
            border-color: rgba(96, 165, 250, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        .reg-btn:hover {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.45);
        }
        .reg-btn:active { transform: translateY(0); }
        .reg-btn::after {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            width: 0; height: 0;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
        }
        .reg-btn:hover::after { width: 400px; height: 400px; }
        .register-card {
            animation: fadeSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

    @push('scripts')
        <script>
            // ── Маска для телефону ──────────────────────────────────────
            const phoneInput = document.getElementById('phone');

            phoneInput.addEventListener('input', function (e) {
                let raw = this.value.replace(/\D/g, ''); // тільки цифри

                // Завжди починається з 380
                if (!raw.startsWith('380')) {
                    raw = '380' + raw.replace(/^380/, '');
                }
                raw = raw.substring(0, 12); // max 12 цифр: 380 + 9

                // Форматуємо: +380 XX XXX XX XX
                let formatted = '+380';
                if (raw.length > 3)  formatted += ' '  + raw.substring(3, 5);
                if (raw.length > 5)  formatted += ' '  + raw.substring(5, 8);
                if (raw.length > 8)  formatted += ' '  + raw.substring(8, 10);
                if (raw.length > 10) formatted += ' '  + raw.substring(10, 12);

                this.value = formatted;
            });

            phoneInput.addEventListener('keydown', function (e) {
                // Не дозволяємо видалити префікс +380
                if (e.key === 'Backspace' && this.value.replace(/\D/g, '').length <= 3) {
                    e.preventDefault();
                }
            });

            phoneInput.addEventListener('focus', function () {
                if (!this.value || this.value === '') this.value = '+380 ';
            });

            // Перед відправкою форми — перетворюємо у +380XXXXXXXXX
            phoneInput.closest('form').addEventListener('submit', function () {
                phoneInput.value = '+' + phoneInput.value.replace(/\D/g, '');
            });

            // ── Показати / Приховати пароль ─────────────────────────────
            function togglePassword(inputId, eyeId) {
                const input = document.getElementById(inputId);
                const eye   = document.getElementById(eyeId);
                if (input.type === 'password') {
                    input.type = 'text';
                    eye.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
                } else {
                    input.type = 'password';
                    eye.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
                }
            }
        </script>
    @endpush

@endsection
