<header class="fixed w-full bg-black shadow z-50">

    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <a href="/" class="text-2xl font-bold text-blue-600">
            Travel
        </a>

        <form action="{{ route('tours.index') }}" method="GET" class="flex gap-2">
            <input
                type="text"
                name="title"
                placeholder="Пошук туру..."
                class="border rounded px-3 py-2"
            />
            <select name="country_id" class="custom-select bg-black border border-gray-600 text-white rounded px-3 py-2 pr-8 cursor-pointer focus:outline-none transition">
                <option value="">Країна</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            <button class="bg-blue-600 text-white px-4 rounded">
                Знайти
            </button>
        </form>

        <div class="flex items-center gap-4">

            <a href="{{ route('cart.index') }}" class="relative">
                🛒
                <span class="absolute -top-2 -right-2 text-xs bg-red-500 text-white px-1 rounded-full">
                    {{ count(session('cart', [])) }}
                </span>
            </a>

            @guest
                <a href="{{ route('login') }}" class="text-white hover:text-blue-400 transition">
                    Вхід
                </a>
            @else
                {{-- Dropdown меню користувача --}}
                <div class="relative" id="user-menu-wrapper">

                    {{-- Кнопка з іменем --}}
                    <button
                        id="user-menu-btn"
                        onclick="toggleUserMenu()"
                        class="flex w-[90px] items-center gap-2 text-white hover:text-blue-400 transition focus:outline-none"
                    >
                        <span class="text-sm font-medium">{{ auth()->user()->name }}</span>

                        {{-- Стрілка --}}
                        <svg id="user-menu-arrow" xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4 transition-transform duration-200"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    {{-- Dropdown --}}
                    <div
                        id="user-dropdown"
                        class="hidden absolute right-0 mt-2 w-52 rounded-xl shadow-2xl overflow-hidden"
                        style="background: rgba(15,15,15,0.97); border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(20px); top: calc(100% + 8px);"
                    >
                        {{-- Шапка меню --}}
                        <div class="px-4 py-3" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                            <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs truncate" style="color: rgba(255,255,255,0.4);">{{ auth()->user()->email }}</p>
                        </div>

                        {{-- Пункти меню --}}
                        <div class="py-1">
                            <a href="{{ route('profile.show') }}"
                               class="flex items-center gap-3 px-4 py-2 text-sm transition-colors"
                               style="color: rgba(255,255,255,0.75);"
                               onmouseover="this.style.background='rgba(255,255,255,0.06)'; this.style.color='#fff'"
                               onmouseout="this.style.background='transparent'; this.style.color='rgba(255,255,255,0.75)'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Мій профіль
                            </a>

                        </div>

                        {{-- Роздільник --}}
                        <div style="height: 1px; background: rgba(255,255,255,0.08);"></div>

                        {{-- Вихід --}}
                        <div class="py-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button
                                    type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-2 text-sm transition-colors text-left"
                                    style="color: #f87171; background: none; border: none; cursor: pointer;"
                                    onmouseover="this.style.background='rgba(248,113,113,0.08)'"
                                    onmouseout="this.style.background='transparent'">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Вийти
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @endguest

        </div>
    </div>

</header>

@push('styles')
    <style>
        #user-dropdown.show {
            display: block !important;
            animation: dropdownIn 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes dropdownIn {
            from { opacity: 0; transform: translateY(-8px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0)   scale(1); }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function toggleUserMenu() {
            const dropdown = document.getElementById('user-dropdown');
            const arrow    = document.getElementById('user-menu-arrow');
            const isOpen   = dropdown.classList.contains('show');

            if (isOpen) {
                dropdown.classList.remove('show');
                dropdown.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            } else {
                dropdown.classList.remove('hidden');
                dropdown.classList.add('show');
                arrow.style.transform = 'rotate(180deg)';
            }
        }

        // Закрити при кліку поза меню
        document.addEventListener('click', function (e) {
            const wrapper = document.getElementById('user-menu-wrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                const dropdown = document.getElementById('user-dropdown');
                const arrow    = document.getElementById('user-menu-arrow');
                dropdown.classList.remove('show');
                dropdown.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            }
        });
    </script>
@endpush
