<div class="bg-gray-50 min-h-screen">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-700 to-green-800 py-12 px-4 text-center rounded-b-3xl shadow-lg relative overflow-hidden">
        <div class="absolute inset-0">
             <svg class="opacity-10 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                 <path d="M0 0 L50 100 L100 0 Z" fill="white" />
            </svg>
        </div>
        <div class="relative z-10">
            <h1 class="text-3xl font-extrabold text-white sm:text-4xl tracking-tight">Cek Status Layanan</h1>
            <p class="mt-2 text-green-100 text-lg">Pantau progres pengajuan layanan Anda secara real-time.</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto py-12 px-4">

    <!-- Search Box -->
    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 mb-8">
        <form wire:submit.prevent="search" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-grow">
                <label for="tracking_code" class="sr-only">Kode Tracking</label>
                <input type="text" wire:model="tracking_code" id="tracking_code" placeholder="Contoh: CUTI-29012026-ABCDE" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-3 text-lg uppercase tracking-wider font-mono">
                @error('tracking_code') <span class="text-red-500 text-sm mt-1 ml-1">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                <span wire:loading.remove>Cek Status</span>
                <span wire:loading>Mencari...</span>
            </button>
        </form>
    </div>

    <!-- Result Area -->
    @if ($submission)
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-800">{{ $submission->service->name }}</h3>
                    <p class="text-sm text-gray-500">Diajukan: {{ $submission->created_at->format('d M Y H:i') }}</p>
                </div>
                <div class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                    {{ $submission->status == 'approved' ? 'bg-green-100 text-green-800' : 
                       ($submission->status == 'rejected' ? 'bg-red-100 text-red-800' : 
                       ($submission->status == 'process' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800')) }}">
                    {{ 
                        match($submission->status) {
                            'pending' => 'Menunggu',
                            'process' => 'Proses',
                            'approved' => 'Selesai',
                            'rejected' => 'Ditolak',
                            default => $submission->status
                        }
                    }}
                </div>
            </div>
            
            <div class="p-6">
                <!-- Timeline -->
                <div class="relative border-l-2 border-gray-200 ml-3 space-y-8">
                    @foreach ($logs as $log)
                        <div class="relative pl-8">
                            <!-- Dot -->
                            <div class="absolute -left-2.5 top-0 w-5 h-5 rounded-full border-2 border-white 
                                {{ $loop->first ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                            
                            <div>
                                <span class="text-xs text-gray-500 font-mono">{{ $log->created_at->format('d M Y, H:i') }}</span>
                                <h4 class="text-base font-bold text-gray-800 capitalize">
                                    {{ 
                                        match($log->status) {
                                            'pending' => 'Menunggu',
                                            'process' => 'Proses',
                                            'approved' => 'Selesai',
                                            'rejected' => 'Ditolak',
                                            default => $log->status
                                        }
                                    }}
                                </h4>
                                @if ($log->note)
                                    <p class="text-gray-600 mt-1 bg-gray-50 p-2 rounded text-sm italic">"{{ $log->note }}"</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    
                    <!-- Initial Submission -->
                    <div class="relative pl-8">
                        <div class="absolute -left-2.5 top-0 w-5 h-5 rounded-full border-2 border-white bg-green-500"></div>
                        <div>
                            <span class="text-xs text-gray-500 font-mono">{{ $submission->created_at->format('d M Y, H:i') }}</span>
                            <h4 class="text-base font-bold text-gray-800">Permohonan Diterima</h4>
                            <p class="text-gray-600 mt-1 text-sm">Sistem telah menerima permohonan Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
</div>
