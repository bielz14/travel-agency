@extends('layouts.app')

@section('content')

    {{-- HERO з відеофоном на весь екран браузера --}}
    <section class="relative w-full h-[500px] overflow-hidden">

        <video
            autoplay
            muted
            loop
            playsinline
            class="absolute inset-0 w-full h-full object-cover">
            <source src="/videos/coverr-a-road-through-the-hills-6377-1080p.mp4" type="video/mp4">
            <source src="/videos/coverr-a-road-through-the-hills-6377-1080p.webm" type="video/webm">
            Ваш браузер не підтримує HTML5 відео.
        </video>

        <div class="absolute inset-0 bg-black/50"></div>

        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-6">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                <span class="main-title">НАЙКРАЩІ ВРАЖЕННЯ СВІТУ</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-8">
                <span class="sub-title">Відкрийте унікальні тури разом з нами!</span>
            </p>
            <a href="{{ route('tours.index') }}"
               class="px-2 py-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                Переглянути тури
            </a>
        </div>

    </section>


    <section class="bg-black py-16">

        <h2 class="text-white text-3xl font-bold text-center mb-10">
            Топ мандрівки
        </h2>

        <div class="max-w-7xl mx-auto px-6">
            <div class="relative">
                <div class="swiper mySwiper overflow-hidden">
                    <div class="swiper-wrapper" style="height: 420px;">
                        @foreach($tours as $tour)
                            <div class="swiper-slide">
                                <div class="tour-card relative block h-full rounded overflow-hidden border border-gray-500">

                                    {{-- Фото --}}
                                    <img
                                        src="{{ $tour->image }}"
                                        alt="{{ $tour->title }}"
                                        class="tour-card__img absolute w-full h-full object-cover">

                                    {{-- Постійне затемнення --}}
                                    <div class="absolute inset-0 bg-black/40"></div>

                                    {{-- Сильніше затемнення при ховері --}}
                                    <div class="tour-card__overlay absolute inset-0" style="background: rgba(0,0,0,0.55);"></div>

                                    {{-- Текст знизу (видимий за замовчуванням) --}}
                                    <div class="tour-card__bottom absolute bottom-6 left-0 right-0 px-6">
                                        <h3 class="text-2xl font-bold text-white">{{ $tour->city->name }}</h3>
                                        <p class="text-sm uppercase text-gray-300 tracking-widest">{{ $tour->country->name }}</p>
                                    </div>

                                    {{-- Центральний блок при ховері --}}
                                    <div class="tour-card__center absolute inset-0 flex flex-col items-center justify-center px-6">
                                        <h3 class="text-2xl font-bold text-white text-center">{{ $tour->city->name }}</h3>
                                        <p class="text-xs uppercase text-gray-300 tracking-widest mb-5 text-center">{{ $tour->country->name }}</p>
                                        <a href="{{ route('tours.show', $tour) }}"
                                           class="tour-card__btn px-5 py-2 text-xs font-semibold tracking-widest uppercase text-white"
                                           style="border: 1px solid rgba(255,255,255,0.7); letter-spacing: 0.15em;">
                                            Показати мандрівку
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button class="swiper-button-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4
                   w-10 h-16 bg-black/70 text-white flex items-center justify-center
                   hover:bg-black transition z-10">
                </button>
                <button class="swiper-button-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-4
                   w-10 h-16 bg-black/70 text-white flex items-center justify-center
                   hover:bg-black transition z-10">
                </button>
            </div>

            <div class="swiper-pagination mt-6"></div>
        </div>

    </section>

@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                pagination: { el: ".swiper-pagination", clickable: true },
                navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
                breakpoints: {
                    640: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 4 },
                },
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* ── Стрілки ── */
        .swiper-button-next,
        .swiper-button-prev {
            transform: translateY(-50%);
            width: 40px !important;
            height: 64px !important;
            color: white !important;
            margin-top: 0 !important;
            margin-left: 6px;
            margin-right: 6px;
        }
        .swiper-button-next { right: -16px; }
        .swiper-button-prev { left: -16px; }
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 16px;
            font-weight: bold;
        }

        /* ── Пагінація ── */
        .swiper-pagination-bullet       { background: white !important; opacity: 0.5 !important; }
        .swiper-pagination-bullet-active{ background: white !important; opacity: 1   !important; }
        .swiper-pagination              { position: relative !important; bottom: 0 !important; }

        /* ── Картка: стан за замовчуванням ── */
        .tour-card__img {
            transform: scale(1);
            transition: transform 0.5s ease;
        }

        /* центральний блок — ЗАВЖДИ прихований */
        .tour-card__center {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.4s ease, transform 0.4s ease;
            pointer-events: none;
        }

        /* нижній текст — завжди видимий */
        .tour-card__bottom {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .tour-card__overlay {
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        /* ── Картка: ховер ── */
        .tour-card:hover .tour-card__img {
            transform: scale(1.08);
        }
        .tour-card:hover .tour-card__overlay {
            opacity: 1;
        }
        .tour-card:hover .tour-card__bottom {
            opacity: 0;
            transform: translateY(20px);
        }
        .tour-card:hover .tour-card__center {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        /* кнопка */
        .tour-card__btn {
            transition: background 0.3s;
        }
        .tour-card__btn:hover {
            background: rgba(255,255,255,0.15);
        }
    </style>
@endpush
