<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Header -->
    <div class="mb-10 text-center">
        <a href="{{ route('layanan.kepegawaian') }}" class="inline-flex items-center text-orange-600 hover:text-orange-700 font-medium mb-4 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Layanan Kepegawaian
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Layanan Pensiun</h1>
        <p class="mt-2 text-lg text-gray-500">Usul Pensiun BUP, Janda/Duda, Uzur, dan Atas Permintaan Sendiri (APS).</p>
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
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h4 class="font-bold text-gray-800 mb-2">Pilih Jenis</h4>
                    <p class="text-sm text-gray-500">Pilih jenis pensiun (BUP, Janda/Duda, dll).</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h4 class="font-bold text-gray-800 mb-2">Upload Berkas</h4>
                    <p class="text-sm text-gray-500">Unggah dokumen persyaratan yang lengkap.</p>
                </div>
                 <!-- Step 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h4 class="font-bold text-gray-800 mb-2">Dapat Kode</h4>
                    <p class="text-sm text-gray-500">Simpan Kode Tracking untuk pengurusan.</p>
                </div>
                 <!-- Step 4 -->
                 <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h4 class="font-bold text-gray-800 mb-2">SK Pensiun</h4>
                    <p class="text-sm text-gray-500">Verifikasi, Proses BKN, dan Penerbitan SK.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Decoration Header -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-2"></div>

        <form wire:submit.prevent="save" class="p-8 space-y-8">
            
            <!-- Type Selector -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <button type="button" wire:click="$set('jenis_pensiun', 'bup')"
                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 focus:outline-none {{ $jenis_pensiun === 'bup' ? 'bg-orange-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    BUP (Batas Usia)
                </button>
                 <button type="button" wire:click="$set('jenis_pensiun', 'janda_duda')"
                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 focus:outline-none {{ $jenis_pensiun === 'janda_duda' ? 'bg-orange-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Janda / Duda
                </button>
                <button type="button" wire:click="$set('jenis_pensiun', 'uzur')"
                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 focus:outline-none {{ $jenis_pensiun === 'uzur' ? 'bg-orange-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Uzur / Tidak Cakap
                </button>
                <button type="button" wire:click="$set('jenis_pensiun', 'aps')"
                    class="px-4 py-3 rounded-lg font-bold text-sm transition-all duration-300 focus:outline-none {{ $jenis_pensiun === 'aps' ? 'bg-orange-600 text-white shadow-md' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    APS (Sendiri)
                </button>
            </div>

            <!-- Section 1: Identitas Pemohon -->
            <section>
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-orange-100 text-orange-600 text-sm font-bold mr-3">1</span>
                    Identitas Pemohon
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 transition shadow-sm">
                        @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" wire:model="email" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 transition shadow-sm" placeholder="Email aktif">
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                        <input type="text" wire:model="nip" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 transition shadow-sm">
                        @error('nip') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">No HP / WhatsApp</label>
                        <input type="text" wire:model="no_hp" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 transition shadow-sm">
                        @error('no_hp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unit Kerja</label>
                        <input type="text" wire:model="unit_kerja" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 transition shadow-sm">
                        @error('unit_kerja') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                        <input type="text" wire:model="jabatan" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 transition shadow-sm">
                        @error('jabatan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pangkat / Golongan</label>
                        <select wire:model="golongan" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 transition shadow-sm">
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
                     @if(in_array($jenis_pensiun, ['bup', 'janda_duda']))
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">TMT Pensiun</label>
                        <input type="date" wire:model="tmt_pensiun" class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500 transition shadow-sm">
                        @error('tmt_pensiun') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif
                </div>
            </section>

            <hr class="border-gray-100">

            <!-- Section 2: Berkas Persyaratan -->
            <section>
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <span class="flex items-center justify-center w-8 h-8 rounded-full bg-orange-100 text-orange-600 text-sm font-bold mr-3">2</span>
                    Berkas Persyaratan
                </h3>
                
                <!-- Internal Process Information -->
                 <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded-r">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <span class="font-bold">Informasi:</span> Berkas SPTJM dan Surat Pernyataan Disiplin/Pidana akan <strong>diproses internal</strong> oleh Kepegawaian (Tidak perlu diupload).
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                     <!-- BUP Specific Top -->
                     @if($jenis_pensiun === 'bup')
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Surat Permohonan dari YBS 
                             <a href="https://docs.google.com/document/d/1sSc6P6G80_ngYaC6qBw_cpEUsYRBdaI-/edit?usp=sharing&ouid=118160140283269731966&rtpof=true&sd=true" target="_blank" class="text-orange-600 underline text-xs ml-1">(Template)</a>
                        </label>
                        <input type="file" wire:model="surat_permohonan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('surat_permohonan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     @endif

                     <!-- Janda/Duda/Uzur/APS Specific Top -->
                     @if(in_array($jenis_pensiun, ['janda_duda', 'uzur', 'aps']))
                      <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Pengantar Usul Pensiun</label>
                        <input type="file" wire:model="surat_pengantar" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('surat_pengantar') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     @endif

                     <!-- Common -->
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK CPNS</label>
                        <input type="file" wire:model="sk_cpns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('sk_cpns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK PNS</label>
                        <input type="file" wire:model="sk_pns" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('sk_pns') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Kenaikan Pangkat Terakhir</label>
                        <input type="file" wire:model="sk_kp_terakhir" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('sk_kp_terakhir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SKP 1 Tahun Terakhir</label>
                        <input type="file" wire:model="skp_1_tahun" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('skp_1_tahun') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kartu Keluarga (KK)</label>
                        <input type="file" wire:model="kk" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('kk') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Akta Nikah (Jika ada)</label>
                        <input type="file" wire:model="akta_nikah" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('akta_nikah') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK KGB Terakhir</label>
                        <input type="file" wire:model="sk_kgb" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('sk_kgb') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK PMK (Jika ada)</label>
                        <input type="file" wire:model="sk_pmk" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('sk_pmk') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Akta Kelahiran Anak (< 25 Thn & Kuliah)</label>
                         <p class="text-xs text-gray-400 mb-1">Sertakan surat pernyataan aktif kuliah jika ada.</p>
                        <input type="file" wire:model="akta_kelahiran_anak" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('akta_kelahiran_anak') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Type Specific Middle -->
                    @if(in_array($jenis_pensiun, ['bup', 'janda_duda']))
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Akta Kelahiran Suami & Istri</label>
                        <input type="file" wire:model="akta_kelahiran_suami_istri" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('akta_kelahiran_suami_istri') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Buku Rekening</label>
                        <input type="file" wire:model="buku_rekening" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('buku_rekening') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">NPWP</label>
                        <input type="file" wire:model="npwp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('npwp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">KTP Suami Istri</label>
                        <input type="file" wire:model="ktp_suami_istri" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('ktp_suami_istri') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pas Foto Suami Istri (3x4, Merah)</label>
                        <input type="file" wire:model="pas_foto" accept="image/png, image/jpeg, image/jpg" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('pas_foto') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">SK Jabatan / Mutasi</label>
                        <input type="file" wire:model="sk_jabatan_mutasi" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('sk_jabatan_mutasi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    @if(in_array($jenis_pensiun, ['janda_duda', 'uzur', 'aps']))
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Akta Nikah/Cerai/Kematian Pasangan</label>
                        <input type="file" wire:model="akta_cerai_kematian" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('akta_cerai_kematian') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    @if($jenis_pensiun === 'janda_duda')
                      <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Keterangan Kematian (Kelurahan)</label>
                        <input type="file" wire:model="surat_keterangan_kematian" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('surat_keterangan_kematian') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    @if(in_array($jenis_pensiun, ['uzur', 'aps']))
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">DPCP (Daftar Penerima Calon Pensiun)</label>
                        <input type="file" wire:model="dpcp" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('dpcp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    @if($jenis_pensiun === 'uzur')
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Keterangan Tim Dokter RS Pemerintah</label>
                        <input type="file" wire:model="surat_keterangan_dokter" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('surat_keterangan_dokter') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif

                    @if($jenis_pensiun === 'aps')
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Permohonan APS (Bermeterai)</label>
                        <input type="file" wire:model="surat_permohonan_aps" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('surat_permohonan_aps') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Surat Persetujuan Pensiun APS</label>
                        <input type="file" wire:model="surat_persetujuan_aps" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                        @error('surat_persetujuan_aps') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    @endif


                     <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-4 mt-2"> <h4 class="font-bold text-gray-600">Dokumen Pendidikan (Ijazah & Transkrip)</h4></div>

                     <!-- Education Loop - Simplified for UI -->
                     @foreach(['SD', 'SMP', 'SMA'] as $edu)
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ijazah {{ $edu }}</label>
                        <input type="file" wire:model="ijazah_{{ strtolower($edu) }}" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                         @error('ijazah_'.strtolower($edu)) <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Transkrip {{ $edu }}</label>
                        <input type="file" wire:model="transkrip_{{ strtolower($edu) }}" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                         @error('transkrip_'.strtolower($edu)) <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                     @endforeach

                     <div class="col-span-1 md:col-span-2"> <p class="text-xs text-gray-500">Ijazah S1/S2/S3 (Jika ada)</p></div>
                     @foreach(['S1', 'S2', 'S3'] as $edu)
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ijazah {{ $edu }} (Opsional)</label>
                        <input type="file" wire:model="ijazah_{{ strtolower($edu) }}" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                    </div>
                     <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Transkrip {{ $edu }} (Opsional)</label>
                        <input type="file" wire:model="transkrip_{{ strtolower($edu) }}" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition">
                    </div>
                     @endforeach

                </div>
            </section>

            <!-- Actions -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl flex items-center">
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
