<x-layouts.app>
   <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-700 to-green-800 py-12 px-4 mb-10 text-center rounded-b-3xl shadow-lg relative overflow-hidden">
         <div class="absolute inset-0">
            <svg class="opacity-10 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <path d="M0 100 C 50 0 50 100 100 0 Z" fill="white" />
            </svg>
        </div>
        <div class="relative z-10">
            <h2 class="text-3xl font-extrabold text-white mb-2 tracking-wide">Layanan Kepegawaian</h2>
            <p class="text-green-100 text-lg max-w-2xl mx-auto">Pilih jenis layanan kepegawaian yang Anda butuhkan untuk diproses.</p>
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
                placeholder="Cari layanan (contoh: Cuti, Pensiun, Tugas Belajar)..."
            >
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
            
            <!-- Permohonan Cuti -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.cuti') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-green-100 rounded-xl flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-green-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-700 transition">Permohonan Cuti</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Ajukan cuti tahunan, sakit, besar, dan alasan penting lainnya secara digital.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-green-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-green-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-green-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Magang -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="https://magang.kemenagsby.web.id/" target="_blank" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-orange-200">External</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-orange-700 transition">Pendaftaran Magang</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Pendaftaran magang untuk siswa dan mahasiswa di lingkungan Kemenag Surabaya.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-orange-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-orange-600 uppercase tracking-wider">Kunjungi Website</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-orange-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </div>
            </a>

            <!-- Satya Lencana -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.satya-lencana') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600 group-hover:bg-yellow-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-yellow-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-yellow-700 transition">Pengajuan Satya Lencana</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Usul tanda kehormatan Satya Lencana Karya Satya (10/20/30 Thn).</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-yellow-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-yellow-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-yellow-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Tugas Belajar -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.tugas-belajar') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-blue-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-700 transition">Tugas Belajar</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Pengajuan Tugas Belajar (Biaya Mandiri / Beasiswa).</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-blue-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-blue-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-blue-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Kenaikan Pangkat -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.kenaikan-pangkat') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-purple-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-purple-700 transition">Kenaikan Pangkat</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Pengajuan KP Fungsional, Reguler, Struktural, & PI.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-purple-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-purple-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-purple-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Pensiun -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.pensiun') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-orange-100 rounded-xl flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-orange-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-orange-700 transition">Pensiun</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Pengajuan Pensiun BUP, Janda/Duda, Uzur, & APS.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-orange-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-orange-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-orange-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Jenjang JF -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.jenjang-jf') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-cyan-100 rounded-xl flex items-center justify-center text-cyan-600 group-hover:bg-cyan-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <span class="bg-cyan-100 text-cyan-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-cyan-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-cyan-700 transition">Jenjang JF</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Kenaikan Jenjang & Pengangkatan Pertama Jabatan Fungsional.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-cyan-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-cyan-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-cyan-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- SKPP & SKMI -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.skpp-skmi') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-emerald-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-emerald-700 transition">SKPP & SKMI</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Usul Surat Keputusan Penyesuaian Pendidikan & Surat Keterangan Memiliki Ijazah.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-emerald-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-emerald-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-emerald-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Pencantuman Gelar -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.pencantuman-gelar') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-indigo-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-indigo-700 transition">Pencantuman Gelar</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Usul Pencantuman Gelar Akademik pada SK Kepangkatan.</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-indigo-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-indigo-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-indigo-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </div>
            </a>

            <!-- Karis/Karsu -->
            <a x-show="search === '' || $el.innerText.toLowerCase().includes(search.toLowerCase())" href="{{ route('layanan.karis-karsu') }}" class="group block bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-100 h-full flex flex-col justify-between">
                <div class="p-6 flex-grow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="h-14 w-14 bg-rose-100 rounded-xl flex items-center justify-center text-rose-600 group-hover:bg-rose-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <span class="bg-rose-100 text-rose-800 text-xs font-semibold px-2.5 py-0.5 rounded-full group-hover:bg-rose-200">Online</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-rose-700 transition">KARIS / KARSU</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Pengajuan Kartu Istri (KARIS) atau Kartu Suami (KARSU).</p>
                </div>
                 <div class="bg-gray-50 px-6 py-4 flex justify-between items-center group-hover:bg-rose-50 transition">
                    <span class="text-xs font-semibold text-gray-400 group-hover:text-rose-600 uppercase tracking-wider">Mulai Pengajuan</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-rose-600 transform group-hover:translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
