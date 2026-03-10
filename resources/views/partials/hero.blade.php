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
