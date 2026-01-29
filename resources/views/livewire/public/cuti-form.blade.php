<div class="max-w-5xl mx-auto py-10 px-4">
    <!-- Header Page -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Permohonan Cuti Online</h1>
        <p class="mt-4 text-lg text-gray-500">Ajukan permohonan cuti Anda dengan mudah dan pantau statusnya secara real-time.</p>
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
                    <p class="text-sm text-gray-500">Lengkapi data diri dan detail cuti dengan benar.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h4 class="font-bold text-gray-800 mb-2">Upload Berkas</h4>
                    <p class="text-sm text-gray-500">Unggah dokumen pendukung yang diperlukan.</p>
                </div>
                 <!-- Step 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h4 class="font-bold text-gray-800 mb-2">Dapat Kode</h4>
                    <p class="text-sm text-gray-500">Simpan Kode Tracking untuk cek status.</p>
                </div>
                 <!-- Step 4 -->
                 <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition text-center border border-gray-100">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h4 class="font-bold text-gray-800 mb-2">Verifikasi</h4>
                    <p class="text-sm text-gray-500">Admin memverifikasi dan menyetujui.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
            <h2 class="text-2xl font-bold text-white">Formulir Pengajuan</h2>
            <p class="text-green-100 mt-1">Pastikan data yang Anda masukkan sesuai.</p>
        </div>

        <div class="p-8">
            @if (session()->has('message'))
                <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-r-lg mb-8 animate-fade-in-down">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg leading-6 font-medium text-green-800">Permohonan Berhasil Dikirim!</h3>
                            <div class="mt-2 text-sm text-green-700">
                                <p>Silakan simpan Kode Tracking Anda ini untuk mengecek status secara berkala.</p>
                                <div class="mt-3">
                                    <span class="inline-flex items-center px-4 py-2 rounded-md border border-transparent text-lg font-bold bg-green-200 text-green-800 tracking-wider shadow-sm select-all">
                                        {{ $tracking_code }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="button" wire:click="$set('tracking_code', null)" class="text-sm font-medium text-green-600 hover:text-green-500 underline focus:outline-none">
                                    Ajukan Permohonan Baru &rarr;
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else

            <form wire:submit="save" class="space-y-8">
                <!-- Identitas Diri Section -->
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Identitas Pemohon
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">Nama Lengkap</label>
                            <input type="text" wire:model="nama" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3" placeholder="Nama lengkap beserta gelar">
                            @error('nama') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">NIP</label>
                            <input type="text" wire:model="nip" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3" placeholder="18 digit NIP">
                            @error('nip') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">Jabatan</label>
                            <input type="text" wire:model="jabatan" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3">
                            @error('jabatan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">Unit Kerja</label>
                            <input type="text" wire:model="unit_kerja" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3">
                            @error('unit_kerja') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">Pangkat/Golongan</label>
                            <select wire:model="pangkat_golongan" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3">
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
                            @error('pangkat_golongan') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">No. HP (WhatsApp)</label>
                            <input type="text" wire:model="no_hp" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3" placeholder="08...">
                            @error('no_hp') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Detail Cuti Section -->
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                         <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Detail Cuti
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">Jenis Cuti</label>
                            <select wire:model="jenis_cuti" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3 bg-white">
                                <option value="">-- Pilih Jenis Cuti --</option>
                                <option value="Cuti Tahunan">Cuti Tahunan</option>
                                <option value="Cuti Besar">Cuti Besar</option>
                                <option value="Cuti Sakit">Cuti Sakit</option>
                                <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                                <option value="Cuti Karena Alasan Penting">Cuti Karena Alasan Penting</option>
                                <option value="Cuti di Luar Tanggungan Negara">Cuti di Luar Tanggungan Negara</option>
                            </select>
                            @error('jenis_cuti') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">Lama Cuti (Hari)</label>
                            <input type="number" wire:model="lama_hari" min="1" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3">
                            @error('lama_hari') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">Mulai Tanggal</label>
                            <input type="date" wire:model="mulai_tanggal" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3">
                            @error('mulai_tanggal') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="group">
                            <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">Sampai Tanggal</label>
                             <input type="date" wire:model="sampai_tanggal" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3">
                            @error('sampai_tanggal') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-6 group">
                        <label class="block text-sm font-medium text-gray-700 mb-1 group-hover:text-green-600 transition">Alasan Cuti</label>
                        <textarea wire:model="alasan_cuti" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 ease-in-out sm:text-sm p-3" placeholder="Jelaskan alasan pengajuan cuti..."></textarea>
                        @error('alasan_cuti') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="group">
                        <label class="block text-sm font-medium text-gray-700 mb-2 group-hover:text-green-600 transition">Upload Berkas Pendukung (PDF/Image)</label>
                        <div class="flex items-center space-x-4">
                            <label class="cursor-pointer bg-white border border-gray-300 rounded-lg px-4 py-2 hover:bg-gray-50 hover:border-green-500 transition shadow-sm">
                                <span class="text-sm font-semibold text-gray-600">Pilih File</span>
                                <input type="file" wire:model="lampiran" class="hidden">
                            </label>
                            <div wire:loading wire:target="lampiran" class="text-sm text-green-600 italic">Uploading...</div>
                            @if ($lampiran)
                                <div class="text-sm text-green-700 font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    {{ $lampiran->getClientOriginalName() }}
                                </div>
                            @else
                                <span class="text-xs text-gray-500">Belum ada file dipilih</span>
                            @endif
                        </div>
                         @error('lampiran') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="pt-4 flex items-center justify-end">
                    <button type="submit" wire:loading.attr="disabled" class="w-full md:w-auto bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform transition hover:-translate-y-0.5 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span wire:loading.remove>Kirim Permohonan</span>
                        <div wire:loading class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Memproses...
                        </div>
                    </button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
