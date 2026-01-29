<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-10 text-center">
        <a href="{{ route('layanan.kepegawaian') }}" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium mb-4 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Layanan Kepegawaian
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Pengajuan Tugas Belajar</h1>
        <p class="mt-2 text-lg text-gray-500">Formulir pengajuan Tugas Belajar (Biaya Mandiri atau Beasiswa).</p>
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

    <!-- Alur Layanan (Service Flow) -->
    <div class="mb-12">
        <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">Alur Layanan</h3>
        <div class="relative">
            <!-- Connecting Line -->
            <div class="absolute inset-x-0 top-1/2 h-0.5 bg-gray-200 transform -translate-y-1/2 hidden md:block z-0"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                <!-- Step 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h4 class="font-bold text-gray-800 mb-2">Isi Formulir</h4>
                    <p class="text-sm text-gray-500">Lengkapi identitas dan pilih jenis tugas belajar.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h4 class="font-bold text-gray-800 mb-2">Upload Berkas</h4>
                    <p class="text-sm text-gray-500">Unggah dokumen sesuai persyaratan.</p>
                </div>
                 <!-- Step 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h4 class="font-bold text-gray-800 mb-2">Dapat Kode</h4>
                    <p class="text-sm text-gray-500">Dapatkan Kode Tracking untuk cek status.</p>
                </div>
                 <!-- Step 4 -->
                 <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h4 class="font-bold text-gray-800 mb-2">Verifikasi</h4>
                    <p class="text-sm text-gray-500">Admin memverifikasi dan menerbitkan SK.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Decoration Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-2"></div>

        <form wire:submit.prevent="save" class="p-8 space-y-8">
            
            <!-- Type Selector -->
            <div class="flex justify-center space-x-4 mb-8" x-data="{ type: @entangle('jenis_tugas_belajar') }">
                <button type="button" @click="type = 'mandiri'" 
                    :class="type === 'mandiri' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                    class="px-6 py-3 rounded-full font-bold transition-all duration-300 focus:outline-none">
                    Biaya Mandiri
                </button>
                 <button type="button" @click="type = 'beasiswa'" 
                    :class="type === 'beasiswa' ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                    class="px-6 py-3 rounded-full font-bold transition-all duration-300 focus:outline-none">
                    Beasiswa
                </button>
            </div>

            <!-- Section 1: Identitas Pemohon -->
            <section>
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-bold mr-3">1</span>
                    Identitas Pemohon
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div class="col-span-1">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" id="nama" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" placeholder="Nama lengkap beserta gelar">
                        @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <!-- NIP -->
                    <div class="col-span-1">
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" wire:model="nip" id="nip" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" placeholder="19xxxxxxxxxxxxxx">
                        @error('nip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- No HP -->
                    <div class="col-span-1">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No HP / WhatsApp</label>
                        <input type="text" wire:model="no_hp" id="no_hp" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" placeholder="08xxxxxxxxxx">
                        @error('no_hp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Unit Kerja -->
                    <div class="col-span-1">
                        <label for="unit_kerja" class="block text-sm font-medium text-gray-700 mb-1">Unit Kerja</label>
                        <input type="text" wire:model="unit_kerja" id="unit_kerja" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" placeholder="Contoh: MAN 1 Surabaya">
                        @error('unit_kerja') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                     <!-- Jabatan -->
                    <div class="col-span-1">
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input type="text" wire:model="jabatan" id="jabatan" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm" placeholder="Contoh: Guru Madya">
                        @error('jabatan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                     <!-- Golongan -->
                    <div class="col-span-1">
                        <label for="golongan" class="block text-sm font-medium text-gray-700 mb-1">Pangkat / Golongan</label>
                        <select wire:model="golongan" id="golongan" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 transition shadow-sm">
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

            <!-- Section 2: Berkas Adminstrasi -->
            <section>
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-600 text-sm font-bold mr-3">2</span>
                    Berkas Persyaratan
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Surat Pengantar -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pengantar Pimpinan Unit Kerja</label>
                        <input type="file" wire:model="surat_pengantar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                         <p class="text-xs text-gray-400 mt-1">PDF/JPG, Maks 2MB.</p>
                        @error('surat_pengantar') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                     <!-- Surat Pernyataan -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Surat Pernyataan Tidak Sedang Hukuman Disciplin 
                            <a href="https://docs.google.com/document/d/1E6OOp6WtbY27F_q2XNj2r_6-s3K1c7SH/edit?usp=sharing&ouid=103425330812976643893&rtpof=true&sd=true" target="_blank" class="text-blue-600 underline text-xs ml-1">(Template)</a>
                        </label>
                        <input type="file" wire:model="surat_pernyataan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                         @error('surat_pernyataan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Surat Perjanjian -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                             Surat Perjanjian Tugas Belajar
                             <a href="https://docs.google.com/document/d/1in055b6-Uh6rzNmgmJpA_DKBkwO4TcFy/edit?usp=sharing&ouid=103425330812976643893&rtpof=true&sd=true" target="_blank" class="text-blue-600 underline text-xs ml-1">(Template)</a>
                        </label>
                        <input type="file" wire:model="surat_perjanjian" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                        @error('surat_perjanjian') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                     <!-- SKP -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SKP 2 Tahun Terakhir (Min. Baik)</label>
                        <input type="file" wire:model="skp_2_tahun" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                         <p class="text-xs text-gray-400 mt-1">PDF, Maks 5MB.</p>
                        @error('skp_2_tahun') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                     <!-- Surat Diterima -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Keterangan Diterima PT</label>
                        <input type="file" wire:model="surat_diterima" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                        @error('surat_diterima') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                     <!-- Akreditasi -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sertifikat Akreditasi Prodi (Min. B)</label>
                        <input type="file" wire:model="sertifikat_akreditasi" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                        @error('sertifikat_akreditasi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                     <!-- Jadwal Kuliah -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal Perkuliahan</label>
                        <input type="file" wire:model="jadwal_kuliah" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                        <p class="text-xs text-gray-400 mt-1">Untuk Mandiri: Diluar jam kerja.</p>
                        @error('jadwal_kuliah') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Beasiswa Only -->
                    @if($jenis_tugas_belajar === 'beasiswa')
                    <div class="col-span-1 animate-fade-in-up">
                        <label class="block text-sm font-medium text-gray-700 mb-1 bg-blue-100 px-2 py-0.5 rounded w-fit text-blue-800">Surat Keterangan Beasiswa</label>
                        <input type="file" wire:model="surat_keterangan_beasiswa" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">
                        @error('surat_keterangan_beasiswa') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                </div>
            </section>

            <!-- Actions -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl flex items-center">
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
