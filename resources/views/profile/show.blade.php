@extends('layouts.app')

@section('title', 'Мій профіль')

@section('content')

    <div class="min-h-screen px-4" style="background: #0a0a0a; padding-top: 3rem; padding-bottom: 5rem;">
        <div class="max-w-2xl mx-auto profile-wrap">

            {{-- Заголовок --}}
            <div class="flex items-center gap-4 mb-8">
                {{-- Великий аватар --}}
                <div class="flex items-center justify-center rounded-full text-2xl font-bold text-white"
                     style="width: 64px; height: 64px; min-width: 64px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-light text-white" style="font-family: 'Georgia', serif;">
                        {{ $user->name }}
                    </h1>
                    <p class="text-sm" style="color: rgba(255,255,255,0.4);">{{ $user->email }}</p>
                </div>
            </div>

            {{-- ── Блок: Особисті дані ── --}}
            <div class="profile-card mb-6" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 2rem;">

                <h2 class="text-sm font-medium mb-6 flex items-center gap-2"
                    style="color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.12em;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Особисті дані
                </h2>

                {{-- Success --}}
                @if(session('success'))
                    <div class="mb-5 px-4 py-3 rounded-lg text-sm flex items-center gap-2"
                         style="background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.25); color: #4ade80;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Ім'я --}}
                    <div class="mb-5">
                        <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.45); letter-spacing: 0.1em; text-transform: uppercase;">
                            Ім'я
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                   class="prof-input w-full pl-11 pr-4 py-3 text-white"
                                   style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('name') ? 'rgba(248,113,113,0.5)' : 'rgba(255,255,255,0.12)' }}; border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s;">
                        </div>
                        @error('name')<p class="mt-1 text-xs" style="color:#f87171;">{{ $message }}</p>@enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-5">
                        <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.45); letter-spacing: 0.1em; text-transform: uppercase;">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                   class="prof-input w-full pl-11 pr-4 py-3 text-white"
                                   style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('email') ? 'rgba(248,113,113,0.5)' : 'rgba(255,255,255,0.12)' }}; border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s;">
                        </div>
                        @error('email')<p class="mt-1 text-xs" style="color:#f87171;">{{ $message }}</p>@enderror
                    </div>

                    {{-- Телефон --}}
                    <div class="mb-7">
                        <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.45); letter-spacing: 0.1em; text-transform: uppercase;">
                            Телефон
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                <span style="font-size: 1rem; line-height: 1;">🇺🇦</span>
                            </div>
                            <input type="tel" name="phone" id="phone_profile"
                                   value="{{ old('phone', $user->phone) }}"
                                   placeholder="+380 XX XXX XX XX"
                                   maxlength="17"
                                   class="prof-input w-full pl-11 pr-4 py-3 text-white"
                                   style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('phone') ? 'rgba(248,113,113,0.5)' : 'rgba(255,255,255,0.12)' }}; border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s; letter-spacing: 0.05em;">
                        </div>
                        @error('phone')
                        <p class="mt-1 text-xs" style="color:#f87171;">{{ $message }}</p>
                        @else
                            <p class="mt-1 text-xs" style="color: rgba(255,255,255,0.25);">Формат: +380 XX XXX XX XX</p>
                            @enderror
                    </div>

                    <button type="submit" class="prof-btn px-6 py-2.5 text-white text-sm font-medium rounded-lg"
                            style="background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none; cursor: pointer; letter-spacing: 0.05em; transition: all 0.3s;">
                        Зберегти зміни
                    </button>

                </form>
            </div>

            {{-- ── Блок: Зміна паролю ── --}}
            <div class="profile-card" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 2rem;">

                <h2 class="text-sm font-medium mb-6 flex items-center gap-2"
                    style="color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.12em;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Зміна паролю
                </h2>

                @if(session('success_password'))
                    <div class="mb-5 px-4 py-3 rounded-lg text-sm flex items-center gap-2"
                         style="background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.25); color: #4ade80;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ session('success_password') }}
                    </div>
                @endif

                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Поточний пароль --}}
                    <div class="mb-5">
                        <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.45); letter-spacing: 0.1em; text-transform: uppercase;">
                            Поточний пароль
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input type="password" name="current_password" id="cur_pass" placeholder="••••••••"
                                   class="prof-input w-full pl-11 pr-10 py-3 text-white"
                                   style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('current_password') ? 'rgba(248,113,113,0.5)' : 'rgba(255,255,255,0.12)' }}; border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s;">
                            <button type="button" onclick="togglePassword('cur_pass','eye_cur')"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4"
                                    style="color: rgba(255,255,255,0.3); background: none; border: none; cursor: pointer;">
                                <svg id="eye_cur" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('current_password')<p class="mt-1 text-xs" style="color:#f87171;">{{ $message }}</p>@enderror
                    </div>

                    {{-- Новий пароль --}}
                    <div class="mb-5">
                        <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.45); letter-spacing: 0.1em; text-transform: uppercase;">
                            Новий пароль
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                            <input type="password" name="password" id="new_pass" placeholder="Мінімум 8 символів"
                                   class="prof-input w-full pl-11 pr-10 py-3 text-white"
                                   style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('password') ? 'rgba(248,113,113,0.5)' : 'rgba(255,255,255,0.12)' }}; border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s;">
                            <button type="button" onclick="togglePassword('new_pass','eye_new')"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4"
                                    style="color: rgba(255,255,255,0.3); background: none; border: none; cursor: pointer;">
                                <svg id="eye_new" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')<p class="mt-1 text-xs" style="color:#f87171;">{{ $message }}</p>@enderror
                    </div>

                    {{-- Підтвердження --}}
                    <div class="mb-7">
                        <label class="block text-xs mb-2" style="color: rgba(255,255,255,0.45); letter-spacing: 0.1em; text-transform: uppercase;">
                            Підтвердження нового паролю
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4" style="color: rgba(255,255,255,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <input type="password" name="password_confirmation" id="conf_pass" placeholder="Повторіть новий пароль"
                                   class="prof-input w-full pl-11 pr-10 py-3 text-white"
                                   style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; outline: none; font-size: 0.95rem; transition: all 0.3s;">
                            <button type="button" onclick="togglePassword('conf_pass','eye_conf')"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4"
                                    style="color: rgba(255,255,255,0.3); background: none; border: none; cursor: pointer;">
                                <svg id="eye_conf" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="prof-btn px-6 py-2.5 text-white text-sm font-medium rounded-lg"
                            style="background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none; cursor: pointer; letter-spacing: 0.05em; transition: all 0.3s;">
                        Змінити пароль
                    </button>

                </form>
            </div>

        </div>
    </div>

    <style>
        .prof-input::placeholder { color: rgba(255,255,255,0.2); }
        .prof-input:focus {
            background: rgba(255,255,255,0.09) !important;
            border-color: rgba(96,165,250,0.55) !important;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.12);
        }
        .prof-btn:hover {
            background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.4);
        }
        .prof-btn:active { transform: translateY(0); }
        .profile-wrap {
            animation: fadeSlideUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

    @push('scripts')
        <script>
            // ── Показати / Приховати пароль ──
            function togglePassword(inputId, eyeId) {
                const input = document.getElementById(inputId);
                const eye   = document.getElementById(eyeId);
                if (input.type === 'password') {
                    input.type = 'text';
                    eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
                } else {
                    input.type = 'password';
                    eye.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
                }
            }

            // ── Маска телефону ──
            const phoneInput = document.getElementById('phone_profile');
            if (phoneInput) {
                phoneInput.addEventListener('input', function () {
                    let raw = this.value.replace(/\D/g, '');
                    if (!raw.startsWith('380')) raw = '380' + raw.replace(/^380/, '');
                    raw = raw.substring(0, 12);
                    let f = '+380';
                    if (raw.length > 3)  f += ' ' + raw.substring(3, 5);
                    if (raw.length > 5)  f += ' ' + raw.substring(5, 8);
                    if (raw.length > 8)  f += ' ' + raw.substring(8, 10);
                    if (raw.length > 10) f += ' ' + raw.substring(10, 12);
                    this.value = f;
                });
                phoneInput.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && this.value.replace(/\D/g, '').length <= 3) e.preventDefault();
                });
                phoneInput.closest('form').addEventListener('submit', function () {
                    phoneInput.value = '+' + phoneInput.value.replace(/\D/g, '');
                });
            }
        </script>
    @endpush

@endsection
