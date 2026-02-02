<x-layouts.app>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-green-700 to-green-900 text-white overflow-hidden">
        <div class="absolute inset-0">
            <svg class="opacity-10 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
            </svg>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 sm:px-6 lg:px-8 flex flex-col items-center text-center z-30">
            <img src="{{ asset('assets/images/logo/kemenag-logo.webp') }}" alt="Logo" class="h-24 w-auto mb-6 drop-shadow-lg animate-fade-in-up">
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl mb-2 drop-shadow-md">
                PTSP FLASH
            </h1>
            <p class="text-lg sm:text-xl font-bold text-green-200 mb-4 tracking-wide uppercase">
                (Fast, Loyal, Afirmatif, Simple, Humble)
            </p>
            <h2 class="text-2xl sm:text-3xl font-semibold text-white mb-8">
                KANTOR KEMENTERIAN AGAMA KOTA SURABAYA
            </h2>
            <p class="text-xl text-green-100 max-w-2xl mx-auto mb-8 font-light">
                Pelayanan Terpadu Satu Pintu (PTSP) kini lebih mudah, cepat, dan transparan melalui Layanan Mandiri Digital.
            </p>
            
            <!-- Search Component -->
            <livewire:public.service-search />

            <div class="flex space-x-4">
                <a href="#layanan" class="bg-yellow-500 hover:bg-yellow-400 text-green-900 font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:scale-105">
                    Mulai Layanan
                </a>
                <a href="{{ route('tracking') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur text-white font-semibold py-3 px-8 rounded-full border border-white/30 transition">
                    Lacak Status
                </a>
            </div>
        </div>
        <!-- Decorative Bottom Shape -->
        <div class="absolute bottom-0 w-full">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0L48 8.875C96 17.75 192 35.5 288 44.375C384 53.25 480 53.25 576 44.375C672 35.5 768 17.75 864 17.75C960 17.75 1056 35.5 1152 44.375C1248 53.25 1344 53.25 1392 53.25H1440V120H1392C1344 120 1248 120 1152 120C1056 120 960 120 864 120C768 120 672 120 576 120C480 120 384 120 288 120C192 120 96 120 48 120H0V0Z" fill="#F3F4F6"/>
            </svg>
        </div>
    </div>

    <!-- Category Grid (Floating Effect) -->
    <div id="layanan" class="bg-gray-100 relative pb-20 pt-10 px-4">
        <div class="max-w-7xl mx-auto -mt-24 relative z-20">
             <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Bimas Islam -->
                <a href="{{ route('layanan.bimas-islam') }}" class="group block p-8 bg-white rounded-xl shadow-xl border border-transparent hover:border-green-500 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-6 -mr-6 w-32 h-32 bg-green-50 rounded-full opacity-50 group-hover:bg-green-100 transition-all duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center text-center">
                         <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-700 transition">Layanan Bimas Islam</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Nikah, Rujuk, Masjid, dan Penyuluhan Agama.</p>
                    </div>
                </a>

                <!-- Zakat & Wakaf -->
                <a href="{{ route('layanan.zawa') }}" class="group block p-8 bg-white rounded-xl shadow-xl border border-transparent hover:border-green-500 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-6 -mr-6 w-32 h-32 bg-green-50 rounded-full opacity-50 group-hover:bg-green-100 transition-all duration-500"></div>
                     <div class="relative z-10 flex flex-col items-center text-center">
                         <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-700 transition">Zakat & Wakaf</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Konsultasi Zakat, Sertifikasi Wakaf, dan Pemberdayaan.</p>
                    </div>
                </a>

                <!-- KUB -->
                <a href="{{ route('layanan.kub') }}" class="group block p-8 bg-white rounded-xl shadow-xl border border-transparent hover:border-green-500 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                     <div class="absolute top-0 right-0 -mt-6 -mr-6 w-32 h-32 bg-green-50 rounded-full opacity-50 group-hover:bg-green-100 transition-all duration-500"></div>
                     <div class="relative z-10 flex flex-col items-center text-center">
                         <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-700 transition">Layanan KUB</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Kerukunan Umat Beragama dan Ormas Keagamaan.</p>
                    </div>
                </a>

                 <!-- Kepegawaian -->
                <a href="{{ route('layanan.kepegawaian') }}" class="group block p-8 bg-white rounded-xl shadow-xl border border-transparent hover:border-green-500 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                     <div class="absolute top-0 right-0 -mt-6 -mr-6 w-32 h-32 bg-green-50 rounded-full opacity-50 group-hover:bg-green-100 transition-all duration-500"></div>
                     <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="h-16 w-16 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-700 transition">Kepegawaian</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Cuti, Kenaikan Pangkat, Pensiun, dan Magang.</p>
                    </div>
                </a>
             </div>
        </div>
    </div>
</x-layouts.app>
