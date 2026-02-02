<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-10 text-center">
        <a href="{{ route('layanan.kepegawaian') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium mb-4 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Layanan Kepegawaian
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Kenaikan Pangkat</h1>
        <p class="mt-2 text-lg text-gray-500">Usul Kenaikan Pangkat Fungsional, Reguler, Struktural, dan Penyesuaian Ijazah.</p>
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
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h4 class="font-bold text-gray-800 mb-2">Pilih Jenis KP</h4>
                    <p class="text-sm text-gray-500">Pilih jenis Kenaikan Pangkat yang sesuai.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h4 class="font-bold text-gray-800 mb-2">Upload Berkas</h4>
                    <p class="text-sm text-gray-500">Unggah dokumen sesuai persyaratan jenis KP.</p>
                </div>
                 <!-- Step 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h4 class="font-bold text-gray-800 mb-2">Dapat Kode</h4>
                    <p class="text-sm text-gray-500">Simpan Kode Tracking untuk layanan ini.</p>
                </div>
                 <!-- Step 4 -->
                 <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h4 class="font-bold text-gray-800 mb-2">Proses BKN</h4>
                    <p class="text-sm text-gray-500">Verifikasi admin & proses persetujuan BKN.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Decoration Header -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2"></div>

        <form wire:submit.prevent="save" class="p-8 space-y-8">
            
            <!-- Type Selector -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <button type="button" wire:click="$set('jenis_kenaikan_pangkat', 'fungsional')"
                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 focus:outline-none {{ $jenis_kenaikan_pangkat === 'fungsional' ? 'bg-purple-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    JF (Fungsional)
                </button>
                 <button type="button" wire:click="$set('jenis_kenaikan_pangkat', 'reguler')"
                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 focus:outline-none {{ $jenis_kenaikan_pangkat === 'reguler' ? 'bg-purple-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Reguler
                </button>
                <button type="button" wire:click="$set('jenis_kenaikan_pangkat', 'struktural')"
                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 focus:outline-none {{ $jenis_kenaikan_pangkat === 'struktural' ? 'bg-purple-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Struktural
                </button>
                <button type="button" wire:click="$set('jenis_kenaikan_pangkat', 'penyesuaian_ijazah')"
                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 focus:outline-none {{ $jenis_kenaikan_pangkat === 'penyesuaian_ijazah' ? 'bg-purple-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Penyesuaian Ijazah
                </button>
            </div>

            <!-- Section 1: Identitas Pemohon -->
            <section>
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-purple-100 text-purple-600 text-sm font-bold mr-3">1</span>
                    Identitas Pemohon
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500 transition shadow-sm">
                        @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" wire:model="email" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500 transition shadow-sm" placeholder="Email aktif">
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" wire:model="nip" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500 transition shadow-sm">
                        @error('nip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">No HP / WhatsApp</label>
                        <input type="text" wire:model="no_hp" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500 transition shadow-sm">
                        @error('no_hp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unit Kerja</label>
                        <input type="text" wire:model="unit_kerja" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500 transition shadow-sm">
                        @error('unit_kerja') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input type="text" wire:model="jabatan" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500 transition shadow-sm">
                        @error('jabatan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pangkat / Golongan</label>
                        <select wire:model="golongan" class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500 transition shadow-sm">
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
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-purple-100 text-purple-600 text-sm font-bold mr-3">2</span>
                    Berkas Persyaratan
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Common Files -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK CPNS</label>
                        <input type="file" wire:model="sk_cpns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_cpns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK PNS</label>
                        <input type="file" wire:model="sk_pns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_pns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SKP Pertama (1 Tahun Seb.)</label>
                        <input type="file" wire:model="skp_1" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('skp_1') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SKP Kedua (2 Tahun Seb.)</label>
                        <input type="file" wire:model="skp_2" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('skp_2') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK KP Terakhir</label>
                        <input type="file" wire:model="sk_kp_terakhir" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_kp_terakhir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ijazah (Sesuai SK KP Terakhir)</label>
                        <input type="file" wire:model="ijazah" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('ijazah') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Transkrip (Sesuai SK KP Terakhir)</label>
                        <input type="file" wire:model="transkrip" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('transkrip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Fungsional Specific -->
                    @if($jenis_kenaikan_pangkat === 'fungsional')
                    <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-4 mt-2"> <h4 class="font-bold text-gray-600">Dokumen Jabatan Fungsional</h4></div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">PAK Konvensional/Integrasi/Konversi</label>
                        <input type="file" wire:model="pak" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('pak') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Pengangkatan Pertama JF</label>
                        <input type="file" wire:model="sk_pengangkatan_pertama_jf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_pengangkatan_pertama_jf') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan Fungsional Terakhir</label>
                        <input type="file" wire:model="sk_jf_terakhir" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_jf_terakhir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Serdik (Bagi Guru)</label>
                        <input type="file" wire:model="serdik" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('serdik') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Penugasan (Bagi Mutasi)</label>
                        <input type="file" wire:model="sk_penugasan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_penugasan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Kenaikan Jenjang (Bagi Alih Jenjang)</label>
                        <input type="file" wire:model="sk_kenaikan_jenjang" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_kenaikan_jenjang') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Tanda Lulus Uji Kompetensi</label>
                        <input type="file" wire:model="uji_kompetensi" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('uji_kompetensi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan Atasan (PLT/PLH/Mutasi)</label>
                        <input type="file" wire:model="sk_jabatan_atasan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_jabatan_atasan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dok. Pendidikan Baru (Izin, Ijazah, Transkrip)</label>
                        <input type="file" wire:model="doc_pendidikan_baru" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        <p class="text-xs text-gray-400 mt-1">Bagi yang ada penambahan gelar.</p>
                        @error('doc_pendidikan_baru') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pencantuman Gelar</label>
                        <input type="file" wire:model="surat_pencantuman_gelar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        <p class="text-xs text-gray-400 mt-1">Bagi yang ada penambahan gelar.</p>
                        @error('surat_pencantuman_gelar') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    <!-- Reguler Specific -->
                    @if($jenis_kenaikan_pangkat === 'reguler')
                    <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-4 mt-2"> <h4 class="font-bold text-gray-600">Dokumen Reguler</h4></div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan Terakhir</label>
                        <input type="file" wire:model="sk_jabatan_terakhir" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_jabatan_terakhir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ujian Dinas (Bagi II/d ke III/a)</label>
                        <input type="file" wire:model="ujian_dinas" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('ujian_dinas') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan Atasan (PLT/PLH/Mutasi)</label>
                        <input type="file" wire:model="sk_jabatan_atasan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_jabatan_atasan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dok. Peningkatan Pendidikan (Ijazah, Transkrip, Surat PG)</label>
                        <input type="file" wire:model="doc_peningkatan_pendidikan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        <p class="text-xs text-gray-400 mt-1">Bagi yang ada peningkatan pendidikan.</p>
                        @error('doc_peningkatan_pendidikan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                     <!-- Struktural Specific -->
                    @if($jenis_kenaikan_pangkat === 'struktural')
                    <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-4 mt-2"> <h4 class="font-bold text-gray-600">Dokumen Struktural</h4></div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan Terakhir</label>
                        <input type="file" wire:model="sk_jabatan_terakhir" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_jabatan_terakhir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pelantikan Jabatan Terakhir</label>
                        <input type="file" wire:model="surat_pelantikan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('surat_pelantikan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ujian Dinas (Bagi II/d ke III/a)</label>
                        <input type="file" wire:model="ujian_dinas" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('ujian_dinas') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan Atasan (PLT/PLH/Mutasi)</label>
                        <input type="file" wire:model="sk_jabatan_atasan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_jabatan_atasan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pencantuman Gelar</label>
                        <input type="file" wire:model="surat_pencantuman_gelar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                         <p class="text-xs text-gray-400 mt-1">Bagi yang ada penambahan gelar.</p>
                        @error('surat_pencantuman_gelar') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    <!-- PI Specific -->
                     @if($jenis_kenaikan_pangkat === 'penyesuaian_ijazah')
                    <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-4 mt-2"> <h4 class="font-bold text-gray-600">Dokumen Penyesuaian Ijazah</h4></div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">STL UPKP</label>
                        <input type="file" wire:model="stl_upkp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('stl_upkp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan Terakhir</label>
                        <input type="file" wire:model="sk_jabatan_terakhir" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('sk_jabatan_terakhir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Uraian Tugas dari Eselon 2</label>
                        <input type="file" wire:model="uraian_tugas" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition">
                        @error('uraian_tugas') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     @endif

                </div>
            </section>

            <!-- Actions -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl flex items-center">
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
