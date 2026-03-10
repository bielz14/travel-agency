{{-- СЕКЦІЯ: ПАРТНЕРИ --}}
<section style="background: #0a0a0a; border-top: 1px solid rgba(255,255,255,0.06); padding: 4rem 0;">

    <div class="text-center mb-10">
        <p class="text-xs uppercase font-bold text-white" style="letter-spacing: 0.4em;">
            Партнери
        </p>
        <div class="mx-auto mt-3" style="width: 40px; height: 1px; background: rgba(37,99,235,0.6);"></div>
    </div>

    @php
        $partners = [
            ['name' => 'The North Face', 'logo' => 'thenorthface.png', 'url' => 'https://www.thenorthface.com'],
            ['name' => 'Core',           'logo' => 'core.png',         'url' => 'https://ridecore.com'],
            ['name' => 'Oakley',         'logo' => 'oakley.png',       'url' => 'https://www.oakley.com'],
            ['name' => 'Armada',         'logo' => 'armada.png',       'url' => 'https://www.armadaskis.com'],
            ["name" => "Arc'teryx",      'logo' => 'arcteryx.png',     'url' => 'https://arcteryx.com'],
            ['name' => 'Smith',          'logo' => 'smith.png',        'url' => 'https://www.smithoptics.com'],
            ['name' => 'First Descents', 'logo' => 'firstdescents.png','url' => 'https://firstdescents.org'],
            ['name' => 'Surefoot',       'logo' => 'surefoot.png',     'url' => 'https://www.surefoot.com'],
            ['name' => 'North',          'logo' => 'north.png',        'url' => 'https://northactionsports.com'],
            ['name' => 'Mystic',         'logo' => 'mystic.png',       'url' => 'https://www.mysticboarding.com'],
            ['name' => 'Norrona',        'logo' => 'norrona.png',      'url' => 'https://www.norrona.com'],
        ];
    @endphp

    {{-- Карусель --}}
    <div style="position: relative; overflow: hidden;">

        {{-- Fade-маски --}}
        <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 100px; z-index: 2;
                    background: linear-gradient(to right, #0a0a0a, transparent); pointer-events: none;"></div>
        <div style="position: absolute; right: 0; top: 0; bottom: 0; width: 100px; z-index: 2;
                    background: linear-gradient(to left, #0a0a0a, transparent); pointer-events: none;"></div>

        {{-- Трек: оригінали + копія для безперервності --}}
        <div class="partners-track" style="display: flex; align-items: center; height: 90px; width: max-content;">

            @foreach([1, 2] as $copy)
                @foreach($partners as $partner)
                    <a href="{{ $partner['url'] }}" target="_blank" rel="noopener"
                       style="display: inline-flex; align-items: center; justify-content: center;
                              min-width: 180px; flex-shrink: 0; padding: 0 28px;">
                        <img src="{{ asset('images/partners/' . $partner['logo']) }}"
                             alt="{{ $partner['name'] }}"
                             style="height: 40px; width: auto; display: block;
                                    opacity: 0.55; transition: opacity 0.3s;"
                             onmouseover="this.style.opacity='1'"
                             onmouseout="this.style.opacity='0.55'"
                             onerror="this.closest('a').style.display='none'">
                    </a>
                @endforeach
            @endforeach

        </div>
    </div>

</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.querySelector('.partners-track');
            if (!track) return;

            const itemW  = 180;   // min-width кожного слайда
            const total  = 11;    // кількість оригінальних партнерів
            const totalW = total * itemW;
            let offset   = 0;

            function step() {
                offset += itemW;

                track.style.transition = 'transform 0.5s ease';
                track.style.transform  = 'translateX(-' + offset + 'px)';

                // Скидаємо коли пройшли всі оригінали
                if (offset >= totalW) {
                    setTimeout(function() {
                        track.style.transition = 'none';
                        track.style.transform  = 'translateX(0)';
                        offset = 0;
                    }, 520);
                }
            }

            // Пауза 2с + анімація 0.5с = перемикання кожні 2.5с
            setInterval(step, 2500);
        });
    </script>
@endpush
