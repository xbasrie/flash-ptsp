<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 py-8 px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white tracking-wide">Konsultasi Wakaf</h2>
            <p class="text-emerald-100 mt-2 text-lg">Formulir Layanan Informasi dan Konsultasi Wakaf</p>
        </div>

        <div class="px-8 mt-6">
            <a href="{{ route('layanan.zawa') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-medium mb-6 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Layanan Zakat & Wakaf
            </a>

            <!-- Alur Layanan (Service Flow) -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">Alur Layanan</h3>
                <div class="relative">
                    <!-- Connecting Line -->
                    <div class="absolute inset-x-0 top-1/2 h-0.5 bg-gray-200 transform -translate-y-1/2 hidden md:block z-0"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                        <!-- Step 1 -->
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                            <h4 class="font-bold text-gray-800 mb-2">Isi Formulir</h4>
                            <p class="text-sm text-gray-500">Isi data diri dan topik konsultasi.</p>
                        </div>
                        <!-- Step 2 -->
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                            <h4 class="font-bold text-gray-800 mb-2">Analisis</h4>
                            <p class="text-sm text-gray-500">Petugas menganalisis pertanyaan Anda.</p>
                        </div>
                         <!-- Step 3 -->
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                            <h4 class="font-bold text-gray-800 mb-2">Jawaban</h4>
                            <p class="text-sm text-gray-500">Jawaban dikirim via WA/Email.</p>
                        </div>
                         <!-- Step 4 -->
                         <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                            <h4 class="font-bold text-gray-800 mb-2">Selesai</h4>
                            <p class="text-sm text-gray-500">Konsultasi selesai atau jadwal temu muka.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form wire:submit.prevent="save" class="p-8 space-y-8">
            <!-- Data Pemohon -->
            <div class="space-y-6">
                 <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Identitas Pemohon</h3>
                 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input wire:model="nama" type="text" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm" placeholder="Masukkan nama lengkap">
                        @error('nama') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- No HP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp / Handphone</label>
                        <input wire:model="no_hp" type="text" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm" placeholder="08xxxxxxxxxx">
                        @error('no_hp') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input wire:model="email" type="email" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm" placeholder="email@contoh.com">
                        @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Topik -->
                 <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Topik / Pertanyaan</label>
                    <textarea wire:model="topik" rows="5" class="w-full rounded-lg border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 transition shadow-sm" placeholder="Tuliskan pertanyaan atau topik yang ingin dikonsultasikan..."></textarea>
                    @error('topik') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" wire:loading.attr="disabled" class="bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                    <span wire:loading.remove>Kirim Permohonan</span>
                    <span wire:loading class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
