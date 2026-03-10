@extends('layouts.app')

@section('title', $tour->title)

@section('content')

    @php
        $days = 1;
        if ($tour->start_date && $tour->end_date) {
            $days = \Carbon\Carbon::parse($tour->start_date)
                ->diffInDays(\Carbon\Carbon::parse($tour->end_date)) + 1;
        }
        $inCart = isset(session('cart')[$tour->id]);
    @endphp

    <div class="min-h-screen" style="background: #0a0a0a; padding-bottom: 5rem;">

        {{-- ── Зображення-герой ── --}}
        <div class="relative w-full overflow-hidden" style="height: 480px; margin-top: -4.5rem;">
            <img src="{{ $tour->image }}" alt="{{ $tour->title }}"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0" style="background: linear-gradient(to bottom, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.75) 100%);"></div>

            {{-- Заголовок поверх зображення --}}
            <div class="relative z-10 flex flex-col justify-end h-full px-6 pb-10 max-w-5xl mx-auto" style="padding-top: 4.5rem;">
                <div class="flex items-center gap-2 mb-3">
                    @if($tour->country)
                        <span class="text-xs uppercase tracking-widest px-3 py-1 rounded-full"
                              style="background: rgba(37,99,235,0.3); border: 1px solid rgba(37,99,235,0.5); color: #93c5fd;">
                    {{ $tour->country->name }}
                </span>
                    @endif
                    @if($tour->city)
                        <span class="text-xs uppercase tracking-widest px-3 py-1 rounded-full"
                              style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.7);">
                    {{ $tour->city->name }}
                </span>
                    @endif
                </div>
                <h1 class="text-4xl font-bold text-white" style="font-family: 'Georgia', serif;">
                    {{ $tour->title }}
                </h1>
            </div>
        </div>

        {{-- ── Контент ── --}}
        <div class="max-w-5xl mx-auto px-6 mt-8">
            <div class="grid gap-8" style="grid-template-columns: 1fr 340px;">

                {{-- ── Ліва частина ── --}}
                <div>

                    {{-- Дати та тривалість --}}
                    <div class="flex items-center gap-6 mb-8 pb-8"
                         style="border-bottom: 1px solid rgba(255,255,255,0.08);">

                        {{-- Тривалість --}}
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full"
                                 style="background: rgba(37,99,235,0.15); border: 1px solid rgba(37,99,235,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #60a5fa;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs" style="color: rgba(255,255,255,0.4);">Тривалість</p>
                                <p class="text-white font-medium">
                                    @if($days <= 1)
                                        Один день
                                    @else
                                        {{ $days }} {{ $days < 5 ? 'Дні пригод' : 'Днів пригод' }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div style="width: 1px; height: 36px; background: rgba(255,255,255,0.1);"></div>

                        {{-- Дата початку --}}
                        @if($tour->start_date)
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full"
                                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: rgba(255,255,255,0.5);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs" style="color: rgba(255,255,255,0.4);">Початок</p>
                                    <p class="text-white font-medium">
                                        {{ \Carbon\Carbon::parse($tour->start_date)->format('d.m.Y') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        {{-- Дата закінчення --}}
                        @if($tour->end_date && $days > 1)
                            <div style="width: 1px; height: 36px; background: rgba(255,255,255,0.1);"></div>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full"
                                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: rgba(255,255,255,0.5);">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs" style="color: rgba(255,255,255,0.4);">Закінчення</p>
                                    <p class="text-white font-medium">
                                        {{ \Carbon\Carbon::parse($tour->end_date)->format('d.m.Y') }}
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Опис --}}
                    <div>
                        <h2 class="text-lg font-medium text-white mb-4">Про тур</h2>
                        <p class="leading-relaxed" style="color: rgba(255,255,255,0.6); line-height: 1.8;">
                            {{ $tour->description }}
                        </p>
                    </div>

                </div>

                {{-- ── Права частина (сайдбар) ── --}}
                <div class="sticky top-24">
                    <div class="rounded-xl p-6" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.09);">

                        {{-- Ціна --}}
                        <div class="mb-6 pb-6" style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                            <p class="text-xs mb-1" style="color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 0.1em;">Вартість</p>
                            <p class="text-3xl font-bold text-white">
                                ${{ number_format($tour->price, 0, '.', ' ') }}
                            </p>
                            <p class="text-xs mt-1" style="color: rgba(255,255,255,0.3);">за особу</p>
                        </div>

                        {{-- Інфо --}}
                        <div class="space-y-3 mb-6">
                            @if($tour->country)
                                <div class="flex items-center justify-between text-sm">
                                    <span style="color: rgba(255,255,255,0.4);">Країна</span>
                                    <span class="text-white">{{ $tour->country->name }}</span>
                                </div>
                            @endif
                            @if($tour->city)
                                <div class="flex items-center justify-between text-sm">
                                    <span style="color: rgba(255,255,255,0.4);">Місто</span>
                                    <span class="text-white">{{ $tour->city->name }}</span>
                                </div>
                            @endif
                            <div class="flex items-center justify-between text-sm">
                                <span style="color: rgba(255,255,255,0.4);">Тривалість</span>
                                <span class="text-white">
                                @if($days <= 1) Один день
                                    @else {{ $days }} {{ $days < 5 ? 'дні' : 'днів' }}
                                    @endif
                            </span>
                            </div>
                        </div>

                        {{-- Кнопка --}}
                        @if($inCart)
                            <form method="POST" action="{{ route('cart.remove', $tour->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full py-3 text-white font-medium text-sm rounded-lg cursor-pointer"
                                        style="background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.4); color: #fca5a5; transition: all 0.3s;"
                                        onmouseover="this.style.background='rgba(239,68,68,0.25)'"
                                        onmouseout="this.style.background='rgba(239,68,68,0.15)'">
                                    Видалити з кошика
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('cart.add', $tour) }}">
                                @csrf
                                <button type="submit"
                                        class="w-full py-3 text-white font-medium text-sm rounded-lg cursor-pointer"
                                        style="background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none; transition: all 0.3s;"
                                        onmouseover="this.style.background='linear-gradient(135deg,#3b82f6,#2563eb)'"
                                        onmouseout="this.style.background='linear-gradient(135deg,#2563eb,#1d4ed8)'">
                                    Забронювати
                                </button>
                            </form>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
