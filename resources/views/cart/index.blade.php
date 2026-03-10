@extends('layouts.app')

@section('title', 'Кошик')

@section('content')

    <div class="min-h-screen px-4" style="background: #0a0a0a; padding-top: 3rem; padding-bottom: 5rem;">
        <div class="max-w-3xl mx-auto">

            {{-- Заголовок --}}
            <div class="flex items-center gap-3 mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h1 class="text-2xl font-light text-white" style="font-family: 'Georgia', serif;">
                    Кошик
                    <span class="text-sm ml-2" style="color: rgba(255,255,255,0.35);">
                    {{ count($cart) }} {{ count($cart) === 1 ? 'тур' : (count($cart) === 0 ? 'турів' : (count($cart) < 5 ? 'тури' : 'турів') ) }}
                </span>
                </h1>
            </div>

            @if(count($cart) === 0)

                {{-- Порожній кошик --}}
                <div class="flex flex-col items-center justify-center py-24"
                     style="border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; background: rgba(255,255,255,0.03);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         style="color: rgba(255,255,255,0.15);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p class="text-lg mb-2" style="color: rgba(255,255,255,0.35);">Кошик порожній</p>
                    <p class="text-sm mb-6" style="color: rgba(255,255,255,0.2);">Додайте тури, які вас зацікавили</p>
                    <a href="{{ route('tours.index') }}"
                       class="px-6 py-2.5 text-sm font-medium text-white rounded-lg"
                       style="background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                        Переглянути тури
                    </a>
                </div>

            @else

                {{-- Список турів --}}
                <div class="flex flex-col gap-4 mb-8">
                    @foreach($cart as $tour)
                        <div class="flex gap-4 p-4 rounded-xl"
                             style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.09);">

                            {{-- Фото --}}
                            <a href="{{ route('tours.show', $tour) }}" class="flex-shrink-0">
                                <img src="{{ $tour->image }}"
                                     alt="{{ $tour->title }}"
                                     class="rounded-lg object-cover"
                                     style="width: 110px; height: 80px;">
                            </a>

                            {{-- Інфо --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('tours.show', $tour) }}">
                                    <h3 class="text-white font-medium truncate hover:text-blue-400 transition">
                                        {{ $tour->title }}
                                    </h3>
                                </a>
                                <p class="text-xs mt-1" style="color: rgba(255,255,255,0.4);">
                                    {{ $tour->country->name ?? '' }}
                                    @if($tour->city)· {{ $tour->city->name }}@endif
                                </p>
                                @if($tour->duration)
                                    <p class="text-xs mt-1" style="color: rgba(255,255,255,0.3);">
                                        🕐 {{ $tour->duration }} днів
                                    </p>
                                @endif
                            </div>

                            {{-- Ціна + Видалити --}}
                            <div class="flex flex-col items-end justify-between flex-shrink-0">
                        <span class="text-white font-semibold text-lg">
                            ${{ number_format($tour->price, 0, '.', ' ') }}
                        </span>

                                <form action="{{ route('cart.remove', $tour->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="flex items-center gap-1 text-xs transition"
                                            style="color: rgba(248,113,113,0.7); background: none; border: none; cursor: pointer;"
                                            onmouseover="this.style.color='#f87171'"
                                            onmouseout="this.style.color='rgba(248,113,113,0.7)'">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Видалити
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- Підсумок --}}
                <div class="rounded-xl p-6" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.09);">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm" style="color: rgba(255,255,255,0.5);">Турів у кошику</span>
                        <span class="text-white">{{ count($cart) }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-6" style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1rem;">
                        <span class="text-white font-medium">Загальна сума</span>
                        <span class="text-xl font-bold text-white">
                        ${{ number_format(collect($cart)->sum('price'), 0, '.', ' ') }}
                    </span>
                    </div>

                    <a href="{{ route('checkout.index') }}"
                       class="w-full py-3 text-white font-medium text-sm rounded-lg text-center block"
                       style="background: linear-gradient(135deg, #2563eb, #1d4ed8); letter-spacing: 0.05em; transition: all 0.3s;"
                       onmouseover="this.style.background='linear-gradient(135deg,#3b82f6,#2563eb)'"
                       onmouseout="this.style.background='linear-gradient(135deg,#2563eb,#1d4ed8)'">
                        Оформити замовлення
                    </a>
                </div>

            @endif

        </div>
    </div>

@endsection
