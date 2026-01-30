<div class="max-w-5xl mx-auto py-10 px-4">
    <!-- Header Page -->
    <div class="text-center mb-10 relative">
        <a href="{{ route('layanan.bimas-islam') }}" class="absolute left-0 top-0 inline-flex items-center text-green-600 hover:text-green-800 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Perubahan Status Musholla ke Masjid</h1>
        <p class="mt-4 text-lg text-gray-500">Ajukan perubahan status rumah ibadah dari Musholla menjadi Masjid.</p>
    </div>

    <!-- Alur Layanan (Service Flow) -->
    <div class="mb-12">
        <h3 class="text-xl font-bold text-gray-800 mb-6 text-center">Alur Layanan</h3>
        <div class="relative">
            <!-- Connecting Line -->
            <div class="absolute inset-x-0 top-1/2 h-0.5 bg-gray-200 transform -translate-y-1/2 hidden md:block z-0"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                <!-- Step 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h4 class="font-bold text-gray-800 mb-2">Isi Formulir</h4>
                    <p class="text-sm text-gray-500">Isi data pemohon dan detail rumah ibadah.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h4 class="font-bold text-gray-800 mb-2">Upload Dokumen</h4>
                    <p class="text-sm text-gray-500">Unggah berkas persyaratan wajib (PDF/Foto).</p>
                </div>
                 <!-- Step 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h4 class="font-bold text-gray-800 mb-2">Dapat Kode</h4>
                    <p class="text-sm text-gray-500">Dapatkan Kode Tracking untuk cek status.</p>
                </div>
                 <!-- Step 4 -->
                 <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h4 class="font-bold text-gray-800 mb-2">Verifikasi</h4>
                    <p class="text-sm text-gray-500">Admin Kemenag memverifikasi pengajuan.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
            <h2 class="text-2xl font-bold text-white">Formulir Pengajuan</h2>
            <p class="text-green-100 mt-1">Isi data dan upload dokumen persyaratan dengan benar.</p>
        </div>

        <div class="p-8">
            <form wire:submit="save" class="space-y-8">
                <!-- Identitas Pemohon -->
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Identitas Pemohon</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemohon</label>
                            <input type="text" wire:model="nama" class="block w-full rounded-lg border-gray-300 p-3 shadow-sm focus:border-green-500 focus:ring-green-500">
                            @error('nama') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. HP (WhatsApp)</label>
                            <input type="text" wire:model="no_hp" class="block w-full rounded-lg border-gray-300 p-3 shadow-sm focus:border-green-500 focus:ring-green-500">
                            @error('no_hp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" wire:model="email" class="block w-full rounded-lg border-gray-300 p-3 shadow-sm focus:border-green-500 focus:ring-green-500">
                            @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Dokumen Persyaratan -->
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Dokumen Persyaratan</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Surat Permohonan <span class="text-gray-500 text-xs">(Dari Takmir ke Kankemenag via KUA)</span></label>
                            <input type="file" wire:model="surat_permohonan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('surat_permohonan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Surat Pernyataan Dukungan <span class="text-gray-500 text-xs">(Masyarakat/Tokoh/Daftar 30+ Nama & KTP)</span></label>
                            <input type="file" wire:model="surat_dukungan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('surat_dukungan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rekomendasi KUA</label>
                            <input type="file" wire:model="rekomendasi_kua" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('rekomendasi_kua') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">SK Pendirian Takmir Masjid</label>
                            <input type="file" wire:model="sk_takmir_masjid" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('sk_takmir_masjid') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bukti Status Tanah <span class="text-gray-500 text-xs">(Sertifikat/AIW/dll)</span></label>
                            <input type="file" wire:model="status_tanah" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('status_tanah') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Surat Pernyataan Tidak Konflik <span class="text-gray-500 text-xs">(Bermaterai)</span></label>
                            <input type="file" wire:model="surat_tidak_konflik" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('surat_tidak_konflik') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Surat Komitmen Kebangsaan <span class="text-gray-500 text-xs">(Bermaterai)</span></label>
                            <input type="file" wire:model="surat_komitmen" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('surat_komitmen') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Fisik Bangunan <span class="text-gray-500 text-xs">(JPG/JPEG)</span></label>
                            <input type="file" wire:model="foto_bangunan" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            @error('foto_bangunan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end">
                    <button type="submit" wire:loading.attr="disabled" class="w-full md:w-auto bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform transition hover:-translate-y-0.5 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span wire:loading.remove>Kirim Permohonan</span>
                        <div wire:loading class="flex items-center">Processing...</div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
