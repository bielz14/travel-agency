@extends('layouts.app')

@section('title', 'Усі тури')

@section('content')

    {{-- ── Баннер ── --}}
    <div class="relative w-full overflow-hidden" style="height: 320px; margin-top: -4.5rem;">
        <img src="/images/banner.jpg" alt="Тури" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.65) 100%);"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-6" style="padding-top: 4.5rem;">
            <h1 class="text-5xl font-bold text-white tracking-widest uppercase mb-3" style="font-family: 'Georgia', serif; letter-spacing: 0.12em;">
                Найкращі тури
            </h1>
            <p class="text-sm" style="color: rgba(255,255,255,0.6); letter-spacing: 0.08em;">
                Обирайте свою наступну пригоду з нашої колекції подорожей
            </p>
        </div>
    </div>

    {{-- ── Основний контент ── --}}
    <div style="background: #0a0a0a; padding-bottom: 5rem;">

        {{-- ── Панель: фільтри + кількість + сортування ── --}}
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between flex-wrap gap-3"
             style="border-bottom: 1px solid rgba(255,255,255,0.07);">

            <div class="flex items-center gap-4 mt-1">
                {{-- Кнопка Filters --}}
                <button onclick="toggleFilters()"
                        id="filters-btn"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white rounded"
                        style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); cursor: pointer; transition: all 0.2s;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>
                    Фільтри
                </button>

                <p class="text-sm" style="color: rgba(255,255,255,0.4);">
                    Знайдено <span class="text-white font-medium">{{ $tours->total() }}</span> турів
                </p>
            </div>

            {{-- Сортування по ціні --}}
            <div class="flex items-center gap-2 text-sm" style="color: rgba(255,255,255,0.45);">
                <span>Ціна:</span>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_asc', 'page' => 1]) }}"
                   class="transition"
                   style="color: {{ request('sort') === 'price_asc' ? '#60a5fa' : 'rgba(255,255,255,0.55)' }}; text-decoration: {{ request('sort') === 'price_asc' ? 'underline' : 'none' }};"
                   onmouseover="this.style.color='#60a5fa'"
                   onmouseout="this.style.color='{{ request('sort') === 'price_asc' ? '#60a5fa' : 'rgba(255,255,255,0.55)' }}'">
                    Низька
                </a>
                <span style="color: rgba(255,255,255,0.2);">|</span>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'price_desc', 'page' => 1]) }}"
                   class="transition"
                   style="color: {{ request('sort') === 'price_desc' ? '#60a5fa' : 'rgba(255,255,255,0.55)' }}; text-decoration: {{ request('sort') === 'price_desc' ? 'underline' : 'none' }};"
                   onmouseover="this.style.color='#60a5fa'"
                   onmouseout="this.style.color='{{ request('sort') === 'price_desc' ? '#60a5fa' : 'rgba(255,255,255,0.55)' }}'">
                    Висока
                </a>
            </div>
        </div>

        {{-- ── Панель фільтрів (прихована) ── --}}
        <div id="filters-panel" class="hidden">
            <div class="max-w-7xl mx-auto px-6 py-6">
                <form action="{{ route('tours.index') }}" method="GET">
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <div class="filters-grid">

                        {{-- Ціна --}}
                        <div class="filter-block">
                            <p class="filter-label">Ціна ($)</p>
                            <div class="flex items-center gap-3">
                                <div class="flex-1">
                                    <label class="filter-sublabel">Від</label>
                                    <input type="number" name="price_min" value="{{ request('price_min') }}"
                                           placeholder="0" min="0"
                                           class="filter-input w-full">
                                </div>
                                <span class="text-sm mt-4" style="color: rgba(255,255,255,0.3);">—</span>
                                <div class="flex-1">
                                    <label class="filter-sublabel">До</label>
                                    <input type="number" name="price_max" value="{{ request('price_max') }}"
                                           placeholder="9999" min="0"
                                           class="filter-input w-full">
                                </div>
                            </div>
                        </div>

                        {{-- Дати --}}
                        <div class="filter-block">
                            <p class="filter-label">Дати туру</p>
                            <div class="flex items-center gap-3">
                                <div class="flex-1">
                                    <label class="filter-sublabel">Від</label>
                                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                                           class="filter-input w-full">
                                </div>
                                <span class="text-sm mt-4" style="color: rgba(255,255,255,0.3);">—</span>
                                <div class="flex-1">
                                    <label class="filter-sublabel">До</label>
                                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                                           class="filter-input w-full">
                                </div>
                            </div>
                        </div>

                        {{-- Гості --}}
                        <div class="filter-block">
                            <p class="filter-label">Кількість гостей</p>
                            <label class="filter-sublabel">Гостей</label>
                            <div class="flex items-center gap-2 mt-1">
                                <button type="button" onclick="changeFilter('guests', -1)"
                                        class="filter-counter-btn">−</button>
                                <input type="number" name="guests" id="filter_guests"
                                       value="{{ request('guests', 0) }}"
                                       min="0" readonly
                                       class="filter-input text-center"
                                       style="width: 64px;">
                                <button type="button" onclick="changeFilter('guests', 1)"
                                        class="filter-counter-btn">+</button>
                            </div>
                        </div>

                    </div>

                    {{-- Кнопки --}}
                    <div class="flex items-center gap-3 mt-6">
                        <button type="submit"
                                class="px-6 py-2.5 text-sm font-medium text-white rounded"
                                style="background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none; cursor: pointer; transition: all 0.3s;"
                                onmouseover="this.style.background='linear-gradient(135deg,#3b82f6,#2563eb)'"
                                onmouseout="this.style.background='linear-gradient(135deg,#2563eb,#1d4ed8)'">
                            Застосувати фільтри
                        </button>
                        <a href="{{ route('tours.index') }}"
                           class="px-6 py-2.5 text-sm font-medium rounded"
                           style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6);">
                            Скинути
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- ── Сітка турів ── --}}
        <div class="max-w-7xl mx-auto px-6 pt-8">
            <div class="tours-grid">
                @foreach($tours as $index => $tour)

                    @if($index % 3 === 0)
                        <div class="tour-card tour-card--large">
                            @else
                                <div class="tour-card">
                                    @endif

                                    {{-- Ціна --}}
                                    <div class="tour-card__price">
                                        <span class="text-xs" style="color: rgba(255,255,255,0.7);">від</span>
                                        <span class="font-bold text-white">${{ number_format($tour->price, 0, '.', ' ') }}</span>
                                    </div>

                                    {{-- Фото --}}
                                    <img src="{{ $tour->image }}" alt="{{ $tour->title }}" class="tour-card__img">

                                    {{-- Затемнення --}}
                                    <div class="absolute inset-0 bg-black/40"></div>
                                    <div class="tour-card__overlay"></div>

                                    {{-- Нижній текст --}}
                                    <div class="tour-card__bottom">
                                        <h3 class="text-xl font-bold text-white leading-tight">{{ $tour->title }}</h3>
                                    </div>

                                    {{-- Центр при ховері --}}
                                    <div class="tour-card__center">
                                        <h3 class="text-xl font-bold text-white text-center leading-tight mb-2">
                                            {{ $tour->title }}
                                        </h3>

                                        @php
                                            $days = 1;
                                            if ($tour->start_date && $tour->end_date) {
                                                $days = \Carbon\Carbon::parse($tour->start_date)
                                                    ->diffInDays(\Carbon\Carbon::parse($tour->end_date)) + 1;
                                            }
                                        @endphp

                                        <div class="flex items-center justify-center gap-6 mb-6">
                                            @if($tour->country)
                                                <div class="flex flex-col items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: rgba(255,255,255,0.7);">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <span class="text-xs text-center" style="color: rgba(255,255,255,0.8);">{{ $tour->country->name }}</span>
                                                </div>
                                            @endif
                                            <div style="width: 1px; height: 36px; background: rgba(255,255,255,0.2);"></div>
                                            <div class="flex flex-col items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: rgba(255,255,255,0.7);">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <span class="text-xs text-center" style="color: rgba(255,255,255,0.8);">
                                @if($days <= 1) Один день
                                                    @else {{ $days }} {{ $days < 5 ? 'Дні пригод' : 'Днів пригод' }}
                                                    @endif
                            </span>
                                            </div>
                                        </div>

                                        <a href="{{ route('tours.show', $tour) }}" class="tour-card__btn">
                                            Показати мандрівку
                                        </a>
                                    </div>

                                </div>
                                @endforeach
                        </div>

                        {{-- ── Пагінація ── --}}
                        @if($tours->hasPages())
                            <div class="flex justify-center mt-12 gap-2">
                                @if($tours->onFirstPage())
                                    <span class="px-4 py-2 rounded text-sm" style="background: rgba(255,255,255,0.04); color: rgba(255,255,255,0.2); cursor: not-allowed;">←</span>
                                @else
                                    <a href="{{ $tours->previousPageUrl() }}" class="px-4 py-2 rounded text-sm text-white" style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1);">←</a>
                                @endif

                                @foreach($tours->getUrlRange(1, $tours->lastPage()) as $page => $url)
                                    @if($page == $tours->currentPage())
                                        <span class="px-4 py-2 rounded text-sm font-medium text-white" style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="px-4 py-2 rounded text-sm" style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6);">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if($tours->hasMorePages())
                                    <a href="{{ $tours->nextPageUrl() }}" class="px-4 py-2 rounded text-sm text-white" style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.1);">→</a>
                                @else
                                    <span class="px-4 py-2 rounded text-sm" style="background: rgba(255,255,255,0.04); color: rgba(255,255,255,0.2); cursor: not-allowed;">→</span>
                                @endif
                            </div>
                        @endif

            </div>
        </div>

        @push('styles')
            <style>
                .tours-grid {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 12px;
                }
                .tour-card--large { grid-column: 1 / -1; height: 520px; }
                .tour-card { position: relative; overflow: hidden; cursor: pointer; height: 380px; }
                .tour-card__img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; transform: scale(1); transition: transform 0.6s ease; }
                .tour-card:hover .tour-card__img { transform: scale(1.06); }
                .tour-card__price { position: absolute; top: 0; right: 0; z-index: 10; display: flex; flex-direction: column; align-items: flex-end; padding: 12px 16px; background: rgba(0,0,0,0.75); gap: 2px; font-size: 0.95rem; }
                .tour-card__overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.5); opacity: 0; transition: opacity 0.4s ease; }
                .tour-card:hover .tour-card__overlay { opacity: 1; }
                .tour-card__bottom { position: absolute; bottom: 0; left: 0; right: 0; padding: 24px; opacity: 1; transform: translateY(0); transition: opacity 0.4s ease, transform 0.4s ease; }
                .tour-card:hover .tour-card__bottom { opacity: 0; transform: translateY(16px); }
                .tour-card__center { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; opacity: 0; transform: translateY(12px); transition: opacity 0.4s ease, transform 0.4s ease; pointer-events: none; }
                .tour-card:hover .tour-card__center { opacity: 1; transform: translateY(0); pointer-events: auto; }
                .tour-card__btn { display: inline-block; padding: 10px 24px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; color: white; border: 1px solid rgba(255,255,255,0.7); transition: background 0.3s ease; text-decoration: none; }
                .tour-card__btn:hover { background: rgba(255,255,255,0.15); }

                /* Фільтри */
                #filters-panel { border-bottom: 1px solid rgba(255,255,255,0.07); }
                .filters-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
                .filter-block { display: flex; flex-direction: column; }
                .filter-label { font-size: 0.7rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: rgba(255,255,255,0.5); margin-bottom: 10px; }
                .filter-sublabel { font-size: 0.7rem; color: rgba(255,255,255,0.35); margin-bottom: 4px; display: block; }
                .filter-input { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; padding: 8px 12px; color: white; font-size: 0.9rem; outline: none; transition: border-color 0.2s; }
                .filter-input:focus { border-color: rgba(96,165,250,0.5); }
                .filter-input::-webkit-calendar-picker-indicator { filter: invert(1) opacity(0.4); cursor: pointer; }
                .filter-counter-btn { width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; color: white; font-size: 1.1rem; cursor: pointer; transition: background 0.2s; }
                .filter-counter-btn:hover { background: rgba(255,255,255,0.15); }
                #filters-btn.active { background: rgba(37,99,235,0.2); border-color: rgba(37,99,235,0.5); color: #60a5fa; }

                @media (max-width: 768px) {
                    .tours-grid { grid-template-columns: 1fr; }
                    .tour-card--large { grid-column: 1; height: 340px; }
                    .tour-card { height: 280px; }
                    .filters-grid { grid-template-columns: 1fr; }
                }
            </style>
        @endpush

        @push('scripts')
            <script>
                function toggleFilters() {
                    const panel = document.getElementById('filters-panel');
                    const btn   = document.getElementById('filters-btn');
                    const isOpen = !panel.classList.contains('hidden');
                    panel.classList.toggle('hidden');
                    btn.classList.toggle('active');
                }

                function changeFilter(field, delta) {
                    const input = document.getElementById('filter_' + field);
                    let val = parseInt(input.value) + delta;
                    if (val < 0) val = 0;
                    input.value = val;
                }

                // Відкрити фільтри якщо є активні параметри
                document.addEventListener('DOMContentLoaded', function () {
                    const hasFilters = {{ (request('price_min') || request('price_max') || request('start_date') || request('end_date') || request('guests')) ? 'true' : 'false' }};
                    if (hasFilters) {
                        document.getElementById('filters-panel').classList.remove('hidden');
                        document.getElementById('filters-btn').classList.add('active');
                    }
                });
            </script>
    @endpush

@endsection
