{{-- СЕКЦІЯ ВІДГУКІВ --}}
<section class="relative overflow-hidden" style="background: #0a0a0a; padding: 5rem 0;">

    <div class="relative z-10 max-w-3xl mx-auto px-6">

        {{-- Успіх --}}
        @if(session('success'))
            <div id="success" class="mb-8 text-sm text-center"
                 style="padding: 16px 24px; border: 1px solid rgba(34,197,94,0.3); background: rgba(34,197,94,0.08); color: #86efac; border-radius: 8px; letter-spacing: 0.05em;">
                {{ session('success') }}
            </div>
        @endif

        @auth
            {{-- ── Тригер ── --}}
            <div id="review-trigger" class="text-center">
                <p class="text-xs uppercase mb-5" style="letter-spacing: 0.4em; color: rgba(255,255,255,0.3);">
                    Поділіться враженнями
                </p>
                <button type="button" onclick="openReviewForm()"
                        class="review-trigger-btn inline-flex items-center gap-3 text-white font-medium"
                        style="padding: 16px 36px; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; background: rgba(255,255,255,0.04); cursor: pointer; transition: all 0.3s; font-size: 0.95rem; letter-spacing: 0.05em;"
                        onmouseover="this.style.background='rgba(37,99,235,0.12)'; this.style.borderColor='rgba(37,99,235,0.4)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.04)'; this.style.borderColor='rgba(255,255,255,0.15)'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #60a5fa;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Залишити відгук
                </button>
            </div>

            {{-- ── Форма (прихована) ── --}}
            <div id="review-form-wrapper"
                 style="overflow: hidden; max-height: 0; opacity: 0; transition: max-height 0.6s cubic-bezier(0.16,1,0.3,1), opacity 0.4s ease;">

                {{-- Заголовок --}}
                <div class="text-center" style="padding-top: 48px; margin-bottom: 40px;">
                    <h2 class="text-4xl font-bold text-white" style="font-family: 'Georgia', serif; letter-spacing: -0.02em;">
                        Ваш відгук
                    </h2>
                    <div class="mx-auto mt-4" style="width: 48px; height: 1px; background: #3b82f6;"></div>
                </div>

                <form action="{{ route('reviews.store') }}" method="POST" class="review-form">
                    @csrf

                    {{-- Тур --}}
                    <div class="review-field" style="margin-bottom: 24px;">
                        <label class="block text-xs uppercase mb-2"
                               style="letter-spacing: 0.12em; color: rgba(255,255,255,0.4);">Тур</label>
                        <select name="tour_id" required class="review-select w-full text-sm text-white"
                                style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; padding: 12px 16px; outline: none; appearance: none; cursor: pointer;">
                            <option value="" disabled selected style="background: #0a0a0a;">Оберіть тур</option>
                            @foreach($tours as $tour)
                                <option value="{{ $tour->id }}" style="background: #0a0a0a;">
                                    {{ $tour->title }}
                                    @if($tour->city) — {{ $tour->city->name }}@endif
                                    @if($tour->country), {{ $tour->country->name }}@endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Оцінка --}}
                    <div class="review-field" style="margin-bottom: 24px;">
                        <label class="block text-xs uppercase mb-3"
                               style="letter-spacing: 0.12em; color: rgba(255,255,255,0.4);">Оцінка</label>
                        <div class="star-rating flex gap-2" id="starRating">
                            @for($i = 5; $i >= 1; $i--)
                                <button type="button"
                                        data-value="{{ $i }}"
                                        class="star-btn"
                                        style="font-size: 2rem; line-height: 1; background: none; border: none; cursor: pointer; color: rgba(255,255,255,0.2); transition: color 0.2s;"
                                        aria-label="{{ $i }} зірок">★</button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="ratingInput" value="5">
                    </div>

                    {{-- Коментар --}}
                    <div class="review-field" style="margin-bottom: 24px;">
                        <label class="block text-xs uppercase mb-2"
                               style="letter-spacing: 0.12em; color: rgba(255,255,255,0.4);">Коментар</label>
                        <textarea name="comment" rows="4"
                                  placeholder="Розкажіть про ваші враження від подорожі..."
                                  class="review-textarea w-full text-sm text-white"
                                  style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; padding: 12px 16px; outline: none; resize: none; color: white;"></textarea>
                    </div>

                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    {{-- Кнопки --}}
                    <div class="flex gap-3">
                        <button type="submit"
                                class="review-submit-btn flex-1 text-white font-medium text-sm"
                                style="padding: 14px; border: none; border-radius: 8px; cursor: pointer; letter-spacing: 0.05em; background: linear-gradient(135deg, #2563eb, #1d4ed8); transition: all 0.3s;"
                                onmouseover="this.style.background='linear-gradient(135deg,#3b82f6,#2563eb)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 8px 25px rgba(37,99,235,0.4)'"
                                onmouseout="this.style.background='linear-gradient(135deg,#2563eb,#1d4ed8)'; this.style.transform=''; this.style.boxShadow=''">
                            Надіслати відгук
                        </button>
                        <button type="button" onclick="closeReviewForm()"
                                style="padding: 14px 20px; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; background: transparent; color: rgba(255,255,255,0.4); cursor: pointer; font-size: 0.85rem; transition: all 0.2s;"
                                onmouseover="this.style.borderColor='rgba(255,255,255,0.25)'; this.style.color='rgba(255,255,255,0.7)'"
                                onmouseout="this.style.borderColor='rgba(255,255,255,0.1)'; this.style.color='rgba(255,255,255,0.4)'">
                            Скасувати
                        </button>
                    </div>

                </form>
            </div>{{-- /review-form-wrapper --}}
        @else
            {{-- Не авторизований --}}
            <div class="text-center" style="padding: 48px 24px; border: 1px solid rgba(255,255,255,0.08); border-radius: 12px;">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-full mb-5"
                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: rgba(255,255,255,0.4);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <p class="text-sm mb-6" style="color: rgba(255,255,255,0.4); letter-spacing: 0.05em;">
                    Щоб залишити відгук, увійдіть до акаунту
                </p>
                <a href="{{ route('login') }}"
                   class="inline-block text-sm font-medium text-white"
                   style="padding: 10px 28px; border-radius: 8px; background: linear-gradient(135deg, #2563eb, #1d4ed8); text-decoration: none; transition: all 0.3s;"
                   onmouseover="this.style.background='linear-gradient(135deg,#3b82f6,#2563eb)'"
                   onmouseout="this.style.background='linear-gradient(135deg,#2563eb,#1d4ed8)'">
                    Увійти
                </a>
            </div>
        @endauth

    </div>
</section>

@push('styles')
    <style>
        .review-select option { background: #0a0a0a; }

        .review-select:focus,
        .review-textarea:focus {
            border-color: rgba(96,165,250,0.5) !important;
            background: rgba(255,255,255,0.06) !important;
        }

        .review-textarea::placeholder { color: rgba(255,255,255,0.2); }

        .review-form .review-field {
            opacity: 0;
            transform: translateY(16px);
            animation: reviewFieldIn 0.5s ease forwards;
        }
        .review-form .review-field:nth-child(1) { animation-delay: 0.1s; }
        .review-form .review-form .review-field:nth-child(2) { animation-delay: 0.2s; }
        .review-form .review-field:nth-child(3) { animation-delay: 0.3s; }

        @keyframes reviewFieldIn {
            to { opacity: 1; transform: translateY(0); }
        }

        .star-rating {
            flex-direction: row-reverse;
            justify-content: flex-end;
        }
        .star-btn.active,
        .star-btn.hovered { color: #facc15 !important; }

        /* Тригер */
        #review-trigger { transition: opacity 0.3s ease, transform 0.3s ease; }

        .review-trigger-btn::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 13px;
            border: 1px solid rgba(37,99,235,0.3);
            animation: triggerPulse 2.5s ease-in-out infinite;
            pointer-events: none;
        }
        .review-trigger-btn { position: relative; }

        @keyframes triggerPulse {
            0%, 100% { opacity: 0; transform: scale(1); }
            50%       { opacity: 1; transform: scale(1.03); }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Зірки
        (function() {
            const stars = document.querySelectorAll('.star-btn');
            const input = document.getElementById('ratingInput');
            if (!stars.length) return;
            let current = 5;

            function highlight(val) {
                stars.forEach(s => {
                    s.classList.toggle('hovered', +s.dataset.value <= val);
                    s.classList.toggle('active', false);
                });
            }
            function setRating(val) {
                current = val;
                input.value = val;
                stars.forEach(s => {
                    s.classList.toggle('active', +s.dataset.value <= val);
                    s.classList.toggle('hovered', false);
                });
            }

            setRating(5);

            stars.forEach(s => {
                s.addEventListener('mouseenter', () => highlight(+s.dataset.value));
                s.addEventListener('mouseleave', () => setRating(current));
                s.addEventListener('click',      () => setRating(+s.dataset.value));
            });
        })();

        // Відкрити форму
        function openReviewForm() {
            const trigger = document.getElementById('review-trigger');
            const wrapper = document.getElementById('review-form-wrapper');
            if (!trigger || !wrapper) return;

            trigger.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            trigger.style.opacity = '0';
            trigger.style.transform = 'translateY(-8px)';

            setTimeout(function() {
                trigger.style.display = 'none';
                wrapper.style.maxHeight = '1200px';
                wrapper.style.opacity = '1';
            }, 280);
        }

        // Закрити форму
        function closeReviewForm() {
            const trigger = document.getElementById('review-trigger');
            const wrapper = document.getElementById('review-form-wrapper');
            if (!trigger || !wrapper) return;

            wrapper.style.maxHeight = '0';
            wrapper.style.opacity = '0';

            setTimeout(function() {
                trigger.style.display = '';
                trigger.style.opacity = '0';
                trigger.style.transform = 'translateY(-8px)';
                setTimeout(function() {
                    trigger.style.opacity = '1';
                    trigger.style.transform = 'translateY(0)';
                }, 20);
            }, 400);
        }

        const el = document.getElementById('success');
        if (el) el.scrollIntoView({ behavior: 'smooth' });
    </script>
@endpush
