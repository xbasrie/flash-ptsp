<x-layouts.app>
   <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-700 to-green-800 py-12 px-4 mb-10 text-center rounded-b-3xl shadow-lg relative overflow-hidden">
         <div class="absolute inset-0">
            <svg class="opacity-10 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <path d="M0 100 C 50 0 50 100 100 0 Z" fill="white" />
            </svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-3xl font-extrabold text-white mb-2 tracking-wide">Layanan Bimas Islam</h2>
            <p class="text-green-100 text-lg max-w-2xl mx-auto">Layanan Nikah, Masjid/Musholla, dan Majelis Taklim.</p>
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
                class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm shadow-md transition duration-200 ease-in-out" 
                placeholder="Cari layanan (contoh: Nikah, Masjid, Majelis Taklim)..."
            >
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            
            <!-- Layanan Nikah -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="https://simkah4.kemenag.go.id/" target="_blank" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-pink-100 rounded-xl flex items-center justify-center text-pink-600 group-hover:bg-pink-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <span class="bg-pink-100 text-pink-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-pink-200">External</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-pink-700 transition">Layanan Nikah</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Pendaftaran Nikah Online terintegrasi melalui SIMKAH Gen 4.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-pink-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-pink-600 uppercase tracking-wider">Kunjungi Website</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-pink-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </div>
            </a>

            <!-- ID Masjid & Musholla -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.bimas-masjid') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-green-100 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-green-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-700 transition">ID Masjid/Musholla</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Permohonan Surat Keterangan Terdaftar (ID) Masjid dan Musholla.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-green-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-green-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-green-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Perubahan Musholla ke Masjid -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.bimas-musholla') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="bg-teal-100 text-teal-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-teal-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-teal-700 transition">Perubahan Status</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Permohonan Perubahan Status Musholla menjadi Masjid.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-teal-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-teal-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-teal-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Majelis Taklim -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.bimas-majelis-taklim') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-indigo-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-700 transition">Majelis Taklim</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Surat Keterangan Terdaftar Majelis Taklim.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-indigo-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-indigo-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-indigo-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

        </div>

        <div class="mt-12 text-center">
            <a href="/" class="inline-flex items-center text-green-700 hover:text-green-900 font-semibold transition hover:underline">
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
