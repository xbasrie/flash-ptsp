<x-layouts.app>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 py-12 px-4 mb-10 text-center rounded-b-3xl shadow-lg relative overflow-hidden">
         <div class="absolute inset-0">
            <svg class="opacity-10 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <path d="M0 100 C 50 0 50 100 100 0 Z" fill="white" />
            </svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-3xl font-extrabold text-white mb-2 tracking-wide">Layanan Zakat & Wakaf</h2>
            <p class="text-emerald-100 text-lg max-w-2xl mx-auto">Layanan Informasi, Konsultasi, dan Pendampingan Zakat & Wakaf.</p>
        </div>
    </div>

    <!-- Search & Cards Container -->
    <div x-data="{ search: '' }" class="px-4 pb-12">
        <!-- Search Bar -->
        <div class="max-w-xl mx-auto mb-10 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            <input 
                x-model="search" 
                type="text" 
                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm shadow-md transition duration-200 ease-in-out" 
                placeholder="Cari layanan (contoh: Wakaf Tunai, Konsultasi)..."
            >
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 max-w-4xl mx-auto">
            
            <!-- Konsultasi Wakaf -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.zawa-konsultasi') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-emerald-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-emerald-700 transition">Konsultasi Wakaf</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Layanan informasi dan konsultasi terkait perwakafan.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-emerald-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-emerald-600 uppercase tracking-wider">Mulai Konsultasi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-emerald-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Wakaf Tunai -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.zawa-tunai') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-green-100 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-green-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-700 transition">Wakaf Tunai</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Layanan ikrar dan pembayaran wakaf tunai via QRIS/Transfer.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-green-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-green-600 uppercase tracking-wider">Mulai Wakaf</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-green-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Pendampingan Wakaf Tanah -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.zawa-tanah') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </div>
                        <span class="bg-teal-100 text-teal-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-teal-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-teal-700 transition">Pendampingan Wakaf Tanah</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Pendampingan pengurusan wakaf tanah d sertifikasi tanah wakaf.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-teal-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-teal-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-teal-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Pergantian Nadzir -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.zawa-nadzir') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-blue-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-700 transition">Pergantian Nadzir</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Layanan permohonan pergantian Nadzir wakaf tanah.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-blue-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-blue-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-blue-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>
            
        </div>

        <div class="mt-12 text-center">
            <a href="/" class="inline-flex items-center text-emerald-700 hover:text-emerald-900 font-semibold transition hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
        
        <!-- No Results Message -->
        <div x-show="search !== '' && $el.querySelectorAll('.grid > a[style*=\'display: none\']').length === $el.querySelectorAll('.grid > a').length" class="text-center py-10 text-gray-500" style="display: none;">
            <p class="text-lg">Tidak ada layanan yang cocok dengan pencarian Anda.</p>
        </div>
    </div>
</x-layouts.app>
