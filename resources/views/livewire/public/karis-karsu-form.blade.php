<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-10 text-center">
        <a href="{{ route('layanan.kepegawaian') }}" class="inline-flex items-center text-rose-600 hover:text-rose-700 font-medium mb-4 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Layanan Kepegawaian
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Layanan KARIS / KARSU</h1>
        <p class="mt-2 text-lg text-gray-500">Pengajuan Kartu Istri (KARIS) atau Kartu Suami (KARSU).</p>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-6 rounded-r-lg shadow-sm animate-fade-in-down">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg leading-6 font-bold text-green-800">Permohonan Berhasil Dikirim!</h3>
                    <div class="mt-2 text-green-700">
                        <p>Silakan simpan Kode Tracking Anda untuk mengecek status layanan:</p>
                        <p class="mt-2 text-3xl font-mono font-bold tracking-wider bg-white px-4 py-2 rounded inline-block border border-green-200 select-all">{{ $tracking_code }}</p>
                    </div>
                     <div class="mt-4">
                        <a href="{{ route('tracking') }}" class="text-sm font-semibold text-green-800 hover:text-green-900 underline">Cek Status Sekarang &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

     <!-- Alur Layanan -->
     <div class="mb-12">
        <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">Alur Layanan</h3>
        <div class="relative">
            <div class="absolute inset-x-0 top-1/2 h-0.5 bg-gray-200 transform -translate-y-1/2 hidden md:block z-0"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                <!-- Step 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h4 class="font-bold text-gray-800 mb-2">Isi Formulir</h4>
                    <p class="text-sm text-gray-500">Lengkapi identitas diri dengan benar.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h4 class="font-bold text-gray-800 mb-2">Upload Berkas</h4>
                    <p class="text-sm text-gray-500">Upload 6 dokumen persyaratan.</p>
                </div>
                 <!-- Step 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h4 class="font-bold text-gray-800 mb-2">Verifikasi & Proses</h4>
                    <p class="text-sm text-gray-500">Tim kami akan memproses pengajuan Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-rose-500 to-rose-600 h-2"></div>

        <form wire:submit.prevent="save" class="p-8 space-y-8">
            
            <!-- Section 1: Identitas Pemohon -->
            <section>
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-rose-100 text-rose-600 text-sm font-bold mr-3">1</span>
                    Identitas Pemohon
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" class="w-full rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500 transition shadow-sm">
                        @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" wire:model="email" class="w-full rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500 transition shadow-sm" placeholder="Email aktif">
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" wire:model="nip" class="w-full rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500 transition shadow-sm">
                        @error('nip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">No HP / WhatsApp</label>
                        <input type="text" wire:model="no_hp" class="w-full rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500 transition shadow-sm">
                        @error('no_hp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unit Kerja</label>
                        <input type="text" wire:model="unit_kerja" class="w-full rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500 transition shadow-sm">
                        @error('unit_kerja') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input type="text" wire:model="jabatan" class="w-full rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500 transition shadow-sm">
                        @error('jabatan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pangkat / Golongan</label>
                         <select wire:model="golongan" class="w-full rounded-lg border-gray-300 focus:border-rose-500 focus:ring-rose-500 transition shadow-sm">
                            <option value="">-- Pilih Golongan --</option>
                            <option value="Juru Muda (I/a)">Juru Muda (I/a)</option>
                            <option value="Juru Muda Tingkat I (I/b)">Juru Muda Tingkat I (I/b)</option>
                            <option value="Juru (I/c)">Juru (I/c)</option>
                            <option value="Juru Tingkat I (I/d)">Juru Tingkat I (I/d)</option>
                            <option value="Pengatur Muda (II/a)">Pengatur Muda (II/a)</option>
                            <option value="Pengatur Muda Tingkat I (II/b)">Pengatur Muda Tingkat I (II/b)</option>
                            <option value="Pengatur (II/c)">Pengatur (II/c)</option>
                            <option value="Pengatur Tingkat I (II/d)">Pengatur Tingkat I (II/d)</option>
                            <option value="Penata Muda (III/a)">Penata Muda (III/a)</option>
                            <option value="Penata Muda Tingkat I (III/b)">Penata Muda Tingkat I (III/b)</option>
                            <option value="Penata (III/c)">Penata (III/c)</option>
                            <option value="Penata Tingkat I (III/d)">Penata Tingkat I (III/d)</option>
                            <option value="Pembina (IV/a)">Pembina (IV/a)</option>
                            <option value="Pembina Tingkat I (IV/b)">Pembina Tingkat I (IV/b)</option>
                            <option value="Pembina Utama Muda (IV/c)">Pembina Utama Muda (IV/c)</option>
                            <option value="Pembina Utama Madya (IV/d)">Pembina Utama Madya (IV/d)</option>
                            <option value="Pembina Utama (IV/e)">Pembina Utama (IV/e)</option>
                            <option value="Golongan I">Golongan I</option>
                            <option value="Golongan II">Golongan II</option>
                            <option value="Golongan III">Golongan III</option>
                            <option value="Golongan IV">Golongan IV</option>
                            <option value="Golongan V">Golongan V</option>
                            <option value="Golongan VI">Golongan VI</option>
                            <option value="Golongan VII">Golongan VII</option>
                            <option value="Golongan VIII">Golongan VIII</option>
                            <option value="Golongan IX">Golongan IX</option>
                            <option value="Golongan X">Golongan X</option>
                            <option value="Golongan XI">Golongan XI</option>
                            <option value="Golongan XII">Golongan XII</option>
                            <option value="Golongan XIII">Golongan XIII</option>
                            <option value="Golongan XIV">Golongan XIV</option>
                            <option value="Golongan XV">Golongan XV</option>
                            <option value="Golongan XVI">Golongan XVI</option>
                            <option value="Golongan XVII">Golongan XVII</option>
                        </select>
                        @error('golongan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </section>

            <hr class="border-gray-100">

            <!-- Section 2: Berkas Persyaratan -->
            <section>
                <div class="flex items-center justify-between mb-6">
                     <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-rose-100 text-rose-600 text-sm font-bold mr-3">2</span>
                        Berkas Persyaratan
                    </h3>
                    <div class="text-xs text-gray-500 italic max-w-xs text-right">
                         Pastikan semua dokumen dalam format PDF (max 2MB), kecuali pasfoto.
                     </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pengantar</label>
                        <input type="file" wire:model="surat_pengantar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition">
                         @error('surat_pengantar') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK CPNS</label>
                        <input type="file" wire:model="sk_cpns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition">
                         @error('sk_cpns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK PNS</label>
                        <input type="file" wire:model="sk_pns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition">
                         @error('sk_pns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Akta Nikah (KUA)</label>
                        <input type="file" wire:model="akta_nikah" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition">
                         @error('akta_nikah') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Blanko Laporan Perkawinan</label>
                        <input type="file" wire:model="laporan_perkawinan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition">
                         @error('laporan_perkawinan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pasfoto 2x3</label>
                        <input type="file" wire:model="pasfoto" accept="image/png, image/jpeg, image/jpg" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition">
                         @error('pasfoto') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </section>

            <!-- Actions -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl flex items-center">
                    <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    <svg wire:loading class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Kirim Permohonan
                </button>
            </div>
        </form>
    </div>
</div>
