@extends('layouts.app')

@section('title', 'Замовлення прийнято')

@section('content')

    <div class="min-h-screen flex items-center justify-center px-4" style="background: #0a0a0a;">
        <div class="w-full max-w-md text-center" style="animation: fadeSlideUp 0.6s cubic-bezier(0.16,1,0.3,1) both;">

            {{-- Іконка успіху --}}
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-6"
                 style="background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.3);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     style="color: #4ade80;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h1 class="text-3xl font-light text-white mb-2" style="font-family: 'Georgia', serif;">
                Дякуємо!
            </h1>
            <p class="mb-1" style="color: rgba(255,255,255,0.5);">
                Ваше замовлення <span class="text-white font-medium">#{{ $booking->id }}</span> прийнято
            </p>
            <p class="text-sm mb-8" style="color: rgba(255,255,255,0.35);">
                Ми зв'яжемося з вами найближчим часом за номером<br>
                <span class="text-white">{{ $booking->guest_phone }}</span>
            </p>

            {{-- Деталі замовлення --}}
            <div class="rounded-xl p-5 mb-6 text-left" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.09);">

                <div class="flex items-center gap-4 mb-4 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.07);">
                    <img src="{{ $booking->tour->image }}" alt="{{ $booking->tour->title }}"
                         class="rounded-lg object-cover flex-shrink-0"
                         style="width: 72px; height: 52px;">
                    <div>
                        <p class="text-white font-medium">{{ $booking->tour->title }}</p>
                        <p class="text-xs" style="color: rgba(255,255,255,0.35);">{{ $booking->tour->country->name ?? '' }}</p>
                    </div>
                </div>

                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span style="color: rgba(255,255,255,0.45);">Гостей</span>
                        <span class="text-white">{{ $booking->guests }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span style="color: rgba(255,255,255,0.45);">Email</span>
                        <span class="text-white">{{ $booking->user->email }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span style="color: rgba(255,255,255,0.45);">Телефон</span>
                        <span class="text-white">{{ $booking->user->phone }}</span>
                    </div>
                    <div class="flex justify-between pt-2" style="border-top: 1px solid rgba(255,255,255,0.07);">
                        <span style="color: rgba(255,255,255,0.45);">Сума</span>
                        <span class="text-white font-bold">${{ number_format($booking->total_price, 0, '.', ' ') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span style="color: rgba(255,255,255,0.45);">Статус</span>
                        <span class="px-2 py-0.5 rounded-full text-xs"
                              style="background: rgba(234,179,8,0.15); color: #fbbf24; border: 1px solid rgba(234,179,8,0.3);">
                        Очікує підтвердження
                    </span>
                    </div>
                </div>
            </div>

            {{-- Кнопки --}}
            <div class="flex flex-col gap-3">
                <a href="{{ route('tours.index') }}"
                   class="w-full py-3 text-white text-sm font-medium rounded-lg text-center"
                   style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                    Переглянути ще тури
                </a>
                <a href="/"
                   class="w-full py-3 text-sm font-medium rounded-lg text-center"
                   style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.7);">
                    На головну
                </a>
            </div>

        </div>
    </div>

    <style>
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

@endsection
