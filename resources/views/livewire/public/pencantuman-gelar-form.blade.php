<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-10 text-center">
        <a href="{{ route('layanan.kepegawaian') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-medium mb-4 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Layanan Kepegawaian
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Layanan Pencantuman Gelar</h1>
        <p class="mt-2 text-lg text-gray-500">Usul Pencantuman Gelar Akademik pada SK Kepangkatan.</p>
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
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h4 class="font-bold text-gray-800 mb-2">Isi Formulir</h4>
                    <p class="text-sm text-gray-500">Lengkapi identitas diri dengan benar.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h4 class="font-bold text-gray-800 mb-2">Upload Berkas</h4>
                    <p class="text-sm text-gray-500">Upload 12 dokumen persyaratan.</p>
                </div>
                 <!-- Step 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h4 class="font-bold text-gray-800 mb-2">Verifikasi & Proses</h4>
                    <p class="text-sm text-gray-500">Tim kami akan memproses pengajuan Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 h-2"></div>

        <form wire:submit.prevent="save" class="p-8 space-y-8">
            
            <!-- Section 1: Identitas Pemohon -->
            <section>
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 text-sm font-bold mr-3">1</span>
                    Identitas Pemohon
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" wire:model="nip" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        @error('nip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">No HP / WhatsApp</label>
                        <input type="text" wire:model="no_hp" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        @error('no_hp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unit Kerja</label>
                        <input type="text" wire:model="unit_kerja" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        @error('unit_kerja') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input type="text" wire:model="jabatan" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                        @error('jabatan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pangkat / Golongan</label>
                         <select wire:model="golongan" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition shadow-sm">
                            <option value="">-- Pilih Golongan --</option>
                            <option value="Juru Muda (Ia)">Juru Muda (Ia)</option>
                            <option value="Juru (Ic)">Juru (Ic)</option>
                            <option value="Pengatur Muda (IIa)">Pengatur Muda (IIa)</option>
                            <option value="Pengatur Muda Tk. I (IIb)">Pengatur Muda Tk. I (IIb)</option>
                            <option value="Pengatur (IIc)">Pengatur (IIc)</option>
                            <option value="Penata Muda (IIIa)">Penata Muda (IIIa)</option>
                            <option value="Penata Muda Tk. I (IIIb)">Penata Muda Tk. I (IIIb)</option>
                            <option value="Penata (IIIc)">Penata (IIIc)</option>
                            <option value="Pembina (IVa)">Pembina (IVa)</option>
                            <option value="Pembina Tingkat I (IVb)">Pembina Tingkat I (IVb)</option>
                            <option value="Pembina Utama Muda (IVc)">Pembina Utama Muda (IVc)</option>
                            <option value="Pembina Utama Madya (IVd)">Pembina Utama Madya (IVd)</option>
                            <option value="Pembina Utama (IVe)">Pembina Utama (IVe)</option>
                             <option value="Golongan I">Golongan I</option>
                            <option value="Golongan II">Golongan II</option>
                            <option value="Golongan V">Golongan V</option>
                            <option value="Golongan VI">Golongan VI</option>
                            <option value="Golongan VII">Golongan VII</option>
                            <option value="Golongan IX">Golongan IX</option>
                            <option value="Golongan X">Golongan X</option>
                            <option value="Golongan XI">Golongan XI</option>
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
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 text-sm font-bold mr-3">2</span>
                        Berkas Persyaratan
                    </h3>
                    <div class="text-xs text-gray-500 italic max-w-xs text-right">
                         Pastikan semua dokumen dalam format PDF (max 2MB), kecuali screenshot.
                     </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Dinas Usul (Kakankemenag)</label>
                        <input type="file" wire:model="surat_usul_kakankemenag" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('surat_usul_kakankemenag') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SPTJM Pengusul (Bermaterai)</label>
                        <input type="file" wire:model="sptjm_bermaterai" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('sptjm_bermaterai') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SPTJM Kakankemenag (Non-Materai)</label>
                        <input type="file" wire:model="sptjm_kakankemenag" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('sptjm_kakankemenag') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ijazah</label>
                        <input type="file" wire:model="ijazah" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('ijazah') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Transkrip Nilai</label>
                        <input type="file" wire:model="transkrip_nilai" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('transkrip_nilai') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dokumen Tugas/Ijin Belajar</label>
                        <input type="file" wire:model="dokumen_tubel_ib" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('dokumen_tubel_ib') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Akreditasi Jurusan</label>
                        <input type="file" wire:model="akreditasi_jurusan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('akreditasi_jurusan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Kenaikan Pangkat Terakhir</label>
                        <input type="file" wire:model="sk_kp_terakhir" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('sk_kp_terakhir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK CPNS</label>
                        <input type="file" wire:model="sk_cpns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('sk_cpns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK PNS</label>
                        <input type="file" wire:model="sk_pns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('sk_pns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan Fungsional</label>
                        <input type="file" wire:model="sk_jabatan_fungsional" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('sk_jabatan_fungsional') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Screenshot PDDIKTI</label>
                        <span class="text-xs text-gray-500 mb-1 block">Contoh: <a href="https://lh7-rt.googleusercontent.com/formsz/AN7BsVAav1GOaynu3d7T4uqj2IFcY4n-rI55Dgc5HMt7soQbbPi5xvMe7JgoTabcxEYUC6QAxi2zyCYGJAPl4f1OZDj27i1ZGrz8Rcjx1lXnSehx2hh6jWvoYifwrIUAbYLrrKzIu_Fp_3DrAVLXcjHjyUrGfMN9Gz3Kjztu05CHT_VHJA29SWdtErzN6OaCdmx061G6fYWIgH9dd2s=w583?key=DcILKcjwjKDYc3OtQ_kAJQ" target="_blank" class="text-indigo-600 hover:underline">Lihat Contoh</a></span>
                        <input type="file" wire:model="screenshot_pddikti" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                         @error('screenshot_pddikti') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </section>

            <!-- Actions -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl flex items-center">
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
