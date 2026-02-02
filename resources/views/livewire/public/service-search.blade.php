<div class="relative w-full max-w-2xl mx-auto mt-8 mb-12">
    <!-- Search Input -->
    <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-6 w-6 text-gray-400 group-focus-within:text-green-600 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input 
            wire:model.live.debounce.300ms="search" 
            type="text" 
            class="block w-full pl-12 pr-4 py-4 rounded-full border-2 border-transparent bg-white/90 backdrop-blur-sm text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-green-500/30 focus:border-green-500 shadow-xl transition-all duration-300 text-lg" 
            placeholder="Cari layanan... (Contoh: Nikah, Cuti, Wakaf)"
        >
        
        <!-- Loading Spinner -->
        <div wire:loading class="absolute inset-y-0 right-0 pr-4 flex items-center">
            <svg class="animate-spin h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>

    <!-- Results Dropdown -->
    @if(strlen($search) >= 2)
        <div class="absolute z-[100] w-full mt-2 bg-white rounded-xl shadow-2xl overflow-hidden border border-gray-100 animate-fade-in-up">
            @if(count($services) > 0)
                <div class="py-2 text-sm text-gray-500 px-4 bg-gray-50 border-b border-gray-100">
                    Ditemukan {{ count($services) }} layanan
                </div>
                <ul>
                    @foreach($services as $service)
                        @php
                            $url = Route::has('layanan.'.$service->slug) ? route('layanan.'.$service->slug) : '#';
                            $target = '_self';
                            if ($service->slug === 'magang') {
                                $url = 'https://magang.kemenagsby.web.id/';
                                $target = '_blank';
                            }
                        @endphp
                        <li class="border-b border-gray-50 last:border-none">
                            <a href="{{ $url }}" target="{{ $target }}" class="block px-6 py-4 hover:bg-green-50 transition-colors duration-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-base font-bold text-gray-800">{{ $service->name }}</div>
                                        <div class="text-sm text-gray-500 line-clamp-1">{{ $service->description }}</div>
                                    </div>
                                     <div class="ml-auto text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="p-8 text-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p>Tidak ditemukan layanan dengan kata kunci "<strong>{{ $search }}</strong>"</p>
                </div>
            @endif
        </div>
    @endif
</div>
