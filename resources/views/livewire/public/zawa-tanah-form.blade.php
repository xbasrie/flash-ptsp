<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-teal-600 to-teal-700 py-8 px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white tracking-wide">Pendampingan Wakaf Tanah</h2>
            <p class="text-teal-100 mt-2 text-lg">Layanan Pendampingan Pengurusan Wakaf Tanah di KUA</p>
        </div>

        <div class="px-8 mt-6">
            <a href="{{ route('layanan.zawa') }}" class="inline-flex items-center text-teal-600 hover:text-teal-700 font-medium mb-6 transition">
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
                            <div class="w-12 h-12 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                            <h4 class="font-bold text-gray-800 mb-2">Daftar</h4>
                            <p class="text-sm text-gray-500">Ajukan permohonan & upload berkas.</p>
                        </div>
                        <!-- Step 2 -->
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                            <h4 class="font-bold text-gray-800 mb-2">Verifikasi</h4>
                            <p class="text-sm text-gray-500">KUA memverifikasi dokumen fisik.</p>
                        </div>
                         <!-- Step 3 -->
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                            <h4 class="font-bold text-gray-800 mb-2">Tinjau Lokasi</h4>
                            <p class="text-sm text-gray-500">Petugas meninjau lokasi tanah wakaf.</p>
                        </div>
                         <!-- Step 4 -->
                         <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                            <h4 class="font-bold text-gray-800 mb-2">Penerbitan</h4>
                            <p class="text-sm text-gray-500">Penerbitan AIW / Pengesahan Nadzir.</p>
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
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input wire:model="nama" type="text" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 transition shadow-sm">
                        @error('nama') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp / Handphone</label>
                        <input wire:model="no_hp" type="text" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 transition shadow-sm">
                        @error('no_hp') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input wire:model="email" type="email" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 transition shadow-sm">
                        @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Upload Dokumen Utama -->
             <div class="space-y-6">
                 <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Dokumen Persyaratan</h3>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">KTP Wakif (PDF/Foto)</label>
                        <input wire:model="ktp_wakif" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                        @error('ktp_wakif') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">KTP Nadzir (PDF/Foto)</label>
                        <input wire:model="ktp_nadzir" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                        @error('ktp_nadzir') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat-Surat Tanah</label>
                        <input wire:model="surat_tanah" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                        @error('surat_tanah') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                 </div>
            </div>

            <!-- Status Sertifikat -->
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                <div class="flex items-center space-x-3 mb-4">
                     <input wire:model.live="has_certificate" type="checkbox" class="h-5 w-5 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                     <label class="text-gray-700 font-medium">Tanah Sudah Bersertifikat?</label>
                </div>
                
                <p class="text-sm text-gray-500 mb-4">
                    @if($has_certificate)
                        Tanah sudah memiliki sertifikat resmi. Tidak diperlukan dokumen tambahan.
                    @else
                        Karena tanah <strong>belum bersertifikat</strong>, mohon lengkapi dokumen tambahan di bawah ini:
                    @endif
                </p>

                <!-- Dokumen Tambahan Conditional -->
                @if(!$has_certificate)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4 animate-fade-in-down">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Riwayat Tanah dari Kelurahan</label>
                        <input wire:model="riwayat_tanah" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                        @error('riwayat_tanah') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pernyataan Penguasaan Fisik</label>
                        <input wire:model="pernyataan_fisik" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                        @error('pernyataan_fisik') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pernyataan Tidak Sengketa</label>
                        <input wire:model="surat_tidak_sengketa" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                        @error('surat_tidak_sengketa') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Tanggung Jawab Mutlak (Pemohon)</label>
                        <input wire:model="tanggung_jawab_mutlak" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition">
                        @error('tanggung_jawab_mutlak') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" wire:loading.attr="disabled" class="bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
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
