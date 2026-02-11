<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 py-8 px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white tracking-wide">Wakaf Tunai</h2>
            <p class="text-green-100 mt-2 text-lg">Ikrar Wakaf Tunai untuk Kesejahteraan Umat</p>
        </div>

        <div class="px-8 mt-6">
            <a href="{{ route('layanan.zawa') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium mb-6 transition">
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
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                            <h4 class="font-bold text-gray-800 mb-2">Ikrar Wakaf</h4>
                            <p class="text-sm text-gray-500">Wakif mengisi formulir ikrar.</p>
                        </div>
                        <!-- Step 2 -->
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                            <h4 class="font-bold text-gray-800 mb-2">Transfer</h4>
                            <p class="text-sm text-gray-500">Transfer dana wakaf / Scan QRIS.</p>
                        </div>
                         <!-- Step 3 -->
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                            <h4 class="font-bold text-gray-800 mb-2">Verifikasi</h4>
                            <p class="text-sm text-gray-500">Petugas memverifikasi dana masuk.</p>
                        </div>
                         <!-- Step 4 -->
                         <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                            <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                            <h4 class="font-bold text-gray-800 mb-2">Sertifikat</h4>
                            <p class="text-sm text-gray-500">Terima Sertifikat Wakaf Tunai.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($isServiceOpen)
        <form wire:submit.prevent="save" class="p-8 space-y-8">
            <!-- Data Wakif -->
            <div class="space-y-6">
                 <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Identitas Wakif</h3>
                 
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Wakif</label>
                        <input wire:model="nama" type="text" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 transition shadow-sm">
                        @error('nama') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK Wakif</label>
                        <input wire:model="nik" type="text" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 transition shadow-sm">
                        @error('nik') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp / Handphone</label>
                        <input wire:model="no_hp" type="text" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 transition shadow-sm">
                        @error('no_hp') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input wire:model="email" type="email" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 transition shadow-sm">
                        @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea wire:model="alamat" rows="3" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 transition shadow-sm"></textarea>
                    @error('alamat') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <!-- Detail Wakaf -->
             <div class="space-y-6">
                 <h3 class="text-xl font-bold text-gray-800 border-b pb-2">Detail Wakaf</h3>

                 <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Berwakaf Sebagai</label>
                        <select wire:model.live="profesi_wakif" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 transition shadow-sm">
                            <option value="">Pilih...</option>
                            <option value="asn">ASN</option>
                            <option value="pelajar">Pelajar</option>
                            <option value="catin">Catin</option>
                            <option value="jamaah_haji">Jamaah Haji</option>
                            <option value="lainnya">Lainnya...</option>
                        </select>
                        @error('profesi_wakif') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        
                        @if($profesi_wakif === 'lainnya')
                            <div class="mt-2 animate-fade-in-down">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sebutkan Profesi Lainnya</label>
                                <input wire:model="profesi_wakif_lainnya" type="text" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 transition shadow-sm" placeholder="Contoh: Pengusaha">
                                @error('profesi_wakif_lainnya') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sumber Dana</label>
                        <select wire:model.live="sumber_dana" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 transition shadow-sm">
                            <option value="">Pilih...</option>
                            <option value="gaji">Gaji</option>
                            <option value="hasil_usaha">Hasil Usaha</option>
                            <option value="warisan">Warisan</option>
                            <option value="lainnya">Lainnya...</option>
                        </select>
                        @error('sumber_dana') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror

                        @if($sumber_dana === 'lainnya')
                            <div class="mt-2 animate-fade-in-down">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sebutkan Sumber Dana Lainnya</label>
                                <input wire:model="sumber_dana_lainnya" type="text" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 transition shadow-sm" placeholder="Contoh: Tabungan Pribadi">
                                @error('sumber_dana_lainnya') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                 </div>

                 <!-- QRIS Payment Info -->
                 <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div class="text-center">
                            <p class="font-bold text-lg mb-4 text-gray-700">Scan QRIS</p>
                            <div class="inline-block bg-white p-2 rounded-lg shadow-sm border">
                                <img src="/assets/images/qris_nazhir.png" alt="QRIS Nadzir BWI" class="max-w-[200px] h-auto mx-auto block">
                            </div>
                        </div>
                        <div>
                             <p class="font-medium text-gray-600 mb-2">Atau transfer melalui rekening:</p>
                             <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Penerima</p>
                                <p class="font-bold text-xl text-gray-800">Nadzir BWI Surabaya 1</p>
                                <div class="my-3 border-t border-gray-100"></div>
                                <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Bank BSI</p>
                                <div class="flex items-center space-x-2">
                                    <p class="font-mono font-bold text-2xl text-green-700">7297299616</p>
                                    <button type="button" onclick="navigator.clipboard.writeText('7297299616')" class="text-gray-400 hover:text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </div>
                             </div>
                        </div>
                    </div>
                 </div>

                 <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti Transfer</label>
                    <input wire:model="bukti_transfer" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition">
                    @error('bukti_transfer') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <!-- Ikrar -->
            <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                <label class="flex items-start">
                    <input wire:model="ikrar" type="checkbox" class="mt-1 h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <span class="ml-3 text-sm text-gray-800 leading-relaxed font-medium">
                        Dengan ini, saya berikrar wakaf tunai kepada Nadzir BWI perwakilan Kota Surabaya untuk kesejahteraan umat, pemberdayaan ekonomi umat, bantuan fakir miskin, anak yatim, beasiswa, dan kesehatan.
                    </span>
                </label>
                @error('ikrar') <p class="text-red-500 text-sm mt-2 ml-8">{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" wire:loading.attr="disabled" class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                    <span wire:loading.remove>Selesaikan Wakaf</span>
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
        @else
            <div class="p-8 text-center bg-gray-50">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Layanan Sedang Ditutup</h3>
                <p class="text-gray-500">Mohon maaf, layanan ini sedang tidak menerima pengajuan baru saat ini. Silakan coba lagi nanti.</p>
                <div class="mt-6">
                     <a href="{{ route('layanan.zawa') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                        &larr; Kembali ke Layanan Zakat & Wakaf
                     </a>
                </div>
            </div>
        @endif
    </div>
</div>
