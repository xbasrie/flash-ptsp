<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-10 text-center">
        <a href="{{ route('layanan.kepegawaian') }}" class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium mb-4 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Layanan Kepegawaian
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Layanan Jenjang JF</h1>
        <p class="mt-2 text-lg text-gray-500">Kenaikan Jenjang & Pengangkatan Pertama Jabatan Fungsional.</p>
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
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                <!-- Step 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h4 class="font-bold text-gray-800 mb-2">Pilih Layanan</h4>
                    <p class="text-sm text-gray-500">Kenaikan Jenjang atau Pengangkatan Pertama.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h4 class="font-bold text-gray-800 mb-2">Pilih Jabatan</h4>
                    <p class="text-sm text-gray-500">Guru, Pengawas, Penghulu, Penyuluh, dll.</p>
                </div>
                 <!-- Step 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h4 class="font-bold text-gray-800 mb-2">Upload Berkas</h4>
                    <p class="text-sm text-gray-500">Lengkapi dokumen sesuai persyaratan.</p>
                </div>
                 <!-- Step 4 -->
                 <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-cyan-100 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h4 class="font-bold text-gray-800 mb-2">Verifikasi</h4>
                    <p class="text-sm text-gray-500">Pantau status verifikasi dan proses.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-cyan-500 to-cyan-600 h-2"></div>

            @if($isServiceOpen)
            <form wire:submit.prevent="save" class="p-8 space-y-8">
                
                <!-- Section 1: Identitas Pemohon -->
                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-cyan-100 text-cyan-600 text-sm font-bold mr-3">1</span>
                        Identitas Pemohon
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" wire:model="nama" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 transition shadow-sm">
                            @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" wire:model="email" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 transition shadow-sm" placeholder="Email aktif">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                            <input type="text" wire:model="nip" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 transition shadow-sm">
                            @error('nip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">No HP / WhatsApp</label>
                            <input type="text" wire:model="no_hp" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 transition shadow-sm">
                            @error('no_hp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unit Kerja</label>
                            <input type="text" wire:model="unit_kerja" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 transition shadow-sm">
                            @error('unit_kerja') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan Saat Ini</label>
                            <input type="text" wire:model="jabatan_saat_ini" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 transition shadow-sm">
                            @error('jabatan_saat_ini') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pangkat / Golongan</label>
                             <select wire:model="golongan" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 transition shadow-sm">
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

                 <!-- Section 2: Detail Layanan -->
                 <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-cyan-100 text-cyan-600 text-sm font-bold mr-3">2</span>
                        Detail Layanan
                    </h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <button type="button" wire:click="$set('jenis_layanan', 'kenaikan_jenjang')"
                                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 border focus:outline-none {{ $jenis_layanan === 'kenaikan_jenjang' ? 'bg-cyan-600 text-white border-cyan-600 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                                    Kenaikan Jenjang JF
                                </button>
                                <button type="button" wire:click="$set('jenis_layanan', 'pengangkatan_pertama')"
                                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 border focus:outline-none {{ $jenis_layanan === 'pengangkatan_pertama' ? 'bg-cyan-600 text-white border-cyan-600 shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                                    Pengangkatan Pertama JF
                                </button>
                            </div>
                            @error('jenis_layanan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        @if($jenis_layanan)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan Fungsional Tujuan</label>
                            <select wire:model.live="jabatan_tujuan" class="w-full rounded-lg border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 transition shadow-sm">
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="guru">Guru</option>
                                <option value="pengawas">Pengawas Sekolah</option>
                                <option value="penghulu">Penghulu</option>
                                <option value="penyuluh">Penyuluh Agama Islam</option>
                                <option value="lainnya">Jabatan Fungsional Lainnya</option>
                            </select>
                            @error('jabatan_tujuan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        @endif
                    </div>
                </section>

                <hr class="border-gray-100">

                <!-- Section 3: Berkas Persyaratan -->
                @if($jenis_layanan && $jabatan_tujuan)
                <section>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-cyan-100 text-cyan-600 text-sm font-bold mr-3">3</span>
                        Berkas Persyaratan
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Common Files -->
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surat Dinas Usulan (Kepala Kemenag)</label>
                            <input type="file" wire:model="surat_din_usulan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('surat_din_usulan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pernyataan Persetujuan</label>
                            <input type="file" wire:model="surat_persetujuan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('surat_persetujuan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">SPTJM</label>
                            <input type="file" wire:model="sptjm" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('sptjm') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        @if($jenis_layanan === 'pengangkatan_pertama')
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surat Keterangan Sehat (Jasmani & Rohani)</label>
                            <input type="file" wire:model="surat_keterangan_sehat" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('surat_keterangan_sehat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surat Ket. Integritas a& Moralitas</label>
                            <input type="file" wire:model="surat_keterangan_integritas" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('surat_keterangan_integritas') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hasil Evaluasi Kinerja (Tim Penilai)</label>
                            <input type="file" wire:model="hasil_evaluasi_kinerja" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('hasil_evaluasi_kinerja') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pernyataan Tidak Hukuman Disiplin</label>
                            <input type="file" wire:model="surat_pernyataan_tidak_hukuman" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('surat_pernyataan_tidak_hukuman') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pernyataan Tidak Pidana</label>
                            <input type="file" wire:model="surat_pernyataan_tidak_pidana" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('surat_pernyataan_tidak_pidana') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pernyataan Tidak Tugas Belajar</label>
                            <input type="file" wire:model="surat_pernyataan_tidak_tugas_belajar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('surat_pernyataan_tidak_tugas_belajar') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        @if($jenis_layanan === 'pengangkatan_pertama')
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ijazah & Transkrip Sesuai Kualifikasi</label>
                            <input type="file" wire:model="ijazah_transkrip" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('ijazah_transkrip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">SK Kenaikan Pangkat Terakhir</label>
                            <input type="file" wire:model="sk_kp_terakhir" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('sk_kp_terakhir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan Terakhir</label>
                            <input type="file" wire:model="sk_jabatan_terakhir" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('sk_jabatan_terakhir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">SKP 2 Tahun Terakhir (Baik)</label>
                            <input type="file" wire:model="skp_2_tahun" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('skp_2_tahun') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        @if($jenis_layanan === 'kenaikan_jenjang')
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">PAK Konvensional / Integrasi 2022</label>
                            <input type="file" wire:model="pak_konvensional" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('pak_konvensional') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">PAK Konversi (2023 - Terbaru)</label>
                            <input type="file" wire:model="pak_konversi" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('pak_konversi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sertifikat Uji Kompetensi</label>
                            <input type="file" wire:model="sertifikat_uji_kompetensi" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('sertifikat_uji_kompetensi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        @if($jenis_layanan === 'pengangkatan_pertama')
                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">PAK Pertama</label>
                            <input type="file" wire:model="pak_pertama" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('pak_pertama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        @endif

                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Anjab, ABK, Peta Jabatan</label>
                            <input type="file" wire:model="anjab_abk" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('anjab_abk') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Variable Requirements -->
                        @if($jenis_layanan === 'pengangkatan_pertama')
                             @if(in_array($jabatan_tujuan, ['guru', 'pengawas']))
                             <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Surat Keterangan Bebas Temuan Irjen</label>
                                <input type="file" wire:model="surat_bebas_temuan_irjen" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                                 @error('surat_bebas_temuan_irjen') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            @endif

                            @if($jabatan_tujuan === 'penghulu')
                             <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">SK CPNS</label>
                                <input type="file" wire:model="sk_cpns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                                 @error('sk_cpns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                             <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">SK PNS</label>
                                <input type="file" wire:model="sk_pns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                                 @error('sk_pns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            @endif
                        @endif

                         <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dokumen Pendukung Lainnya</label>
                            <input type="file" wire:model="dokumen_pendukung" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 transition">
                             @error('dokumen_pendukung') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                    </div>
                </section>
                @endif

                <!-- Actions -->
                <div class="pt-6 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl flex items-center">
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
                         <a href="{{ route('layanan.kepegawaian') }}" class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium">
                            &larr; Kembali ke Layanan Kepegawaian
                         </a>
                    </div>
                </div>
            @endif
    </div>
</div>
