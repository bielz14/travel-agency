{{-- СЕКЦІЯ: ЗВ'ЯЖІТЬСЯ З ЕКСПЕРТОМ --}}
<section style="background: #f4f4f5; padding: 5rem 0;">
    <div class="max-w-5xl mx-auto px-6">
        <div class="flex items-center gap-12 flex-wrap justify-center">

            {{-- Фото --}}
            <div class="flex-shrink-0">
                <div class="rounded-full overflow-hidden"
                     style="width: 200px; height: 200px; border: 4px solid #fff; box-shadow: 0 8px 32px rgba(0,0,0,0.12);">
                    <img src="{{ asset('images/expert.jpg') }}" alt="Експерт"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'; this.parentElement.style.background='#dbeafe'">
                </div>
            </div>

            {{-- Текст --}}
            <div>
                <p class="text-xs uppercase mb-2"
                   style="letter-spacing: 0.3em; color: #6b7280;">
                    Персональна консультація
                </p>
                <h2 class="text-xl font-semibold mb-2"
                    style="color: #374151; letter-spacing: 0.05em; text-transform: uppercase;">
                    Зв'яжіться з експертом
                </h2>
                <a href="tel:+380441234567"
                   class="block font-bold mb-4"
                   style="color: #1d4ed8; text-decoration: none; font-size: 3rem; letter-spacing: -0.02em; line-height: 1.1; transition: color 0.2s;"
                   onmouseover="this.style.color='#2563eb'"
                   onmouseout="this.style.color='#1d4ed8'">
                    +38 044 123-45-67
                </a>
                <p style="color: #6b7280; font-size: 0.95rem; max-width: 420px; line-height: 1.7;">
                    Наші експерти допоможуть підібрати тур, скласти індивідуальний маршрут та відповісти на будь-які запитання.
                </p>
            </div>

        </div>
    </div>
</section>
