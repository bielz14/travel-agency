@extends('layouts.app')

@section('title', 'Оформлення замовлення')

@section('content')

    <div class="min-h-screen px-4" style="background: #0a0a0a; padding-top: 3rem; padding-bottom: 5rem;">
        <div class="max-w-2xl mx-auto">

            {{-- Заголовок --}}
            <div class="flex items-center gap-3 mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: rgba(255,255,255,0.4);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <h1 class="text-2xl font-light text-white" style="font-family: 'Georgia', serif;">
                    Оформлення замовлення
                </h1>
            </div>

            {{-- Тури у замовленні --}}
            <div class="mb-6 rounded-xl overflow-hidden" style="border: 1px solid rgba(255,255,255,0.09);">
                <div class="px-5 py-3" style="background: rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.08);">
                    <p class="text-xs uppercase tracking-widest" style="color: rgba(255,255,255,0.4);">Тури у замовленні</p>
                </div>
                @foreach($cart as $tour)
                    <div class="flex items-center gap-4 px-5 py-4" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <img src="{{ $tour->image }}" alt="{{ $tour->title }}"
                             class="rounded-lg object-cover flex-shrink-0"
                             style="width: 64px; height: 48px;">
                        <div class="flex-1 min-w-0">
                            <p class="text-white text-sm font-medium truncate">{{ $tour->title }}</p>
                            <p class="text-xs" style="color: rgba(255,255,255,0.35);">{{ $tour->country->name ?? '' }}</p>
                        </div>
                        <span class="text-white font-semibold text-sm flex-shrink-0">
                    ${{ number_format($tour->price, 0, '.', ' ') }}
                </span>
                    </div>
                @endforeach
            </div>

            {{-- Дані покупця (з профілю, тільки інфо) --}}
            <div class="mb-6 rounded-xl p-5" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.09);">
                <p class="text-xs uppercase tracking-widest mb-4" style="color: rgba(255,255,255,0.4);">Ваші контактні дані</p>
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center rounded-full text-lg font-bold text-white flex-shrink-0"
                         style="width: 44px; height: 44px; background: linear-gradient(135deg, #2563eb, #1d4ed8);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-white font-medium">{{ $user->name }}</p>
                        <p class="text-xs" style="color: rgba(255,255,255,0.4);">{{ $user->email }}</p>
                        @if($user->phone)
                            <p class="text-xs" style="color: rgba(255,255,255,0.4);">{{ $user->phone }}</p>
                        @endif
                    </div>
                    <a href="{{ route('profile.show') }}"
                       class="ml-auto text-xs"
                       style="color: rgba(96,165,250,0.8);"
                       onmouseover="this.style.color='#60a5fa'"
                       onmouseout="this.style.color='rgba(96,165,250,0.8)'">
                        Змінити
                    </a>
                </div>
            </div>

            {{-- Форма --}}
            <div class="rounded-xl p-6" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.09);">

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    {{-- Кількість гостей --}}
                    <div class="mb-7">
                        <label class="block text-xs mb-3" style="color: rgba(255,255,255,0.45); letter-spacing: 0.1em; text-transform: uppercase;">
                            Кількість гостей
                        </label>
                        <div class="flex items-center gap-3">
                            <button type="button" onclick="changeGuests(-1)"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg text-white text-xl"
                                    style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); cursor: pointer;">
                                −
                            </button>
                            <input type="number" name="guests" id="guests_input"
                                   value="{{ old('guests', 1) }}"
                                   min="1" max="50" readonly
                                   class="text-center text-white text-lg font-semibold w-16 py-2 rounded-lg"
                                   style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); outline: none;">
                            <button type="button" onclick="changeGuests(1)"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg text-white text-xl"
                                    style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); cursor: pointer;">
                                +
                            </button>
                            <span class="text-sm ml-2" style="color: rgba(255,255,255,0.35);">осіб</span>
                        </div>
                        @error('guests')
                        <p class="mt-2 text-xs" style="color:#f87171;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Підсумок --}}
                    <div class="flex justify-between items-center mb-6 px-4 py-3 rounded-lg"
                         style="background: rgba(37,99,235,0.12); border: 1px solid rgba(37,99,235,0.25);">
                        <span class="text-sm text-white">Загальна сума</span>
                        <span class="text-white font-bold text-lg" id="total_display">
                        ${{ number_format($total, 0, '.', ' ') }}
                    </span>
                    </div>

                    <button type="submit"
                            class="co-btn w-full py-3 text-white font-medium text-sm rounded-lg"
                            style="background: linear-gradient(135deg, #2563eb, #1d4ed8); border: none; cursor: pointer; letter-spacing: 0.05em; transition: all 0.3s;">
                        Підтвердити замовлення
                    </button>

                </form>
            </div>

        </div>
    </div>

    <style>
        .co-btn:hover {
            background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.4);
        }
    </style>

    @push('scripts')
        <script>
            const baseTotal = {{ $total }};

            function changeGuests(delta) {
                const input = document.getElementById('guests_input');
                let val = parseInt(input.value) + delta;
                if (val < 1) val = 1;
                if (val > 50) val = 50;
                input.value = val;
                document.getElementById('total_display').textContent =
                    '$' + (baseTotal * val).toLocaleString('uk-UA');
            }
        </script>
    @endpush

@endsection
