<x-layouts.app>
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-teal-700 to-teal-800 py-12 px-4 mb-10 text-center rounded-b-3xl shadow-lg relative overflow-hidden">
         <div class="absolute inset-0">
            <svg class="opacity-10 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <path d="M0 100 C 50 0 50 100 100 0 Z" fill="white" />
            </svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-3xl font-extrabold text-white mb-2 tracking-wide">Layanan KUB</h2>
            <p class="text-teal-100 text-lg max-w-2xl mx-auto">Layanan Kerukunan Umat Beragama (Pendirian Rumah Ibadah, dll).</p>
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
                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 sm:text-sm shadow-md transition duration-200 ease-in-out" 
                placeholder="Cari layanan (contoh: Rumah Ibadah, Rohaniawan)..."
            >
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            
            <!-- Izin Pendirian Rumah Ibadah -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.kub-pendirian') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="bg-teal-100 text-teal-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-teal-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-teal-700 transition">Pendirian Rumah Ibadah</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Rekomendasi izin pendirian rumah ibadah di Kota Surabaya.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-teal-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-teal-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-teal-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Rekomendasi Rohaniawan Asing -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.kub-rohaniawan') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-orange-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-orange-700 transition">Rohaniawan Asing</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Rekomendasi untuk perizinan rohaniawan asing.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-orange-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-orange-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-orange-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Rekomendasi Hak Atas Tanah -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.kub-tanah') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-amber-100 rounded-xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                        </div>
                        <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-amber-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition">Rekomendasi Hak Tanah</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Rekomendasi kepemilikan hak atas tanah rumah ibadah.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-amber-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-amber-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-amber-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>
            
        </div>

        <div class="mt-12 text-center">
            <a href="/" class="inline-flex items-center text-teal-700 hover:text-teal-900 font-semibold transition hover:underline">
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
