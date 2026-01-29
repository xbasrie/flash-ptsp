<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'PTSP Kemenag' }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('show-success-modal', (event) => {
                    let message = event.message;
                    let trackingCode = null;
                    
                    // Extract Tracking Code if present (Format: SERVICE-DATE-RANDOM)
                    const match = message.match(/Kode Tracking Anda:\s*([A-Za-z0-9-]+)/);
                    
                    if (match && match[1]) {
                        trackingCode = match[1];
                        // Replace plain code with clickable HTML
                        message = message.replace(
                            trackingCode, 
                            `<br><b id="clickable-tracking-code" class="inline-block mt-2 px-3 py-1 bg-green-50 text-green-700 rounded-lg border border-green-200 cursor-pointer hover:bg-green-100 transition" title="Klik untuk menyalin" style="font-size: 1.25em;">${trackingCode}</b><br><span class="text-xs text-gray-400 mt-1 inline-block">(Klik kode di atas untuk menyalin)</span>`
                        );
                    }

                    Swal.fire({
                        title: 'Berhasil!',
                        html: message,
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#007D43',
                        didOpen: () => {
                            if (trackingCode) {
                                const codeElement = document.getElementById('clickable-tracking-code');
                                if (codeElement) {
                                    codeElement.addEventListener('click', () => {
                                        navigator.clipboard.writeText(trackingCode).then(() => {
                                            const Toast = Swal.mixin({
                                                toast: true,
                                                position: 'top-end',
                                                showConfirmButton: false,
                                                timer: 2000,
                                                timerProgressBar: true
                                            });
                                            Toast.fire({
                                                icon: 'success',
                                                title: 'Kode berhasil disalin!'
                                            });
                                        });
                                    });
                                }
                            }
                        }
                    });
                });
            });
        </script>
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .bg-kemenag { background-color: #007D43; } /* Kemenag Green */
            .text-kemenag { color: #007D43; }
            .bg-kemenag-dark { background-color: #005F32; }
            .text-gold { color: #D4AF37; } /* Accent Gold */
        </style>
    </head>
    <body class="bg-gray-50 min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
            <div class="container mx-auto px-4 py-3 flex items-center justify-between">
                <a href="/" class="flex items-center space-x-3 group">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Kementerian_Agama_new_logo.png" alt="Logo Kemenag" class="h-10 md:h-12 w-auto group-hover:scale-105 transition-transform duration-300">
                    <div class="flex flex-col">
                        <span class="text-xl md:text-2xl font-extrabold text-gray-800 leading-none tracking-tight">PTSP FLASH</span>
                        <span class="text-[8px] md:text-[10px] font-bold text-kemenag tracking-wide mb-0.5">(Fast, Loyal, Afirmatif, Simple, Humble)</span>
                        <span class="text-[10px] md:text-xs font-semibold text-gray-600">KANTOR KEMENTERIAN AGAMA KOTA SURABAYA</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-6 text-sm font-medium text-gray-600">
                    <a href="/" class="hover:text-kemenag transition">Beranda</a>
                    <a href="/layanan/kepegawaian" class="hover:text-kemenag transition">Kepegawaian</a>
                    <a href="{{ route('tracking') }}" class="hover:text-kemenag transition font-bold text-green-700">Lacak Status Layanan</a>
                </nav>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600 hover:text-green-700 focus:outline-none">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenuOpen" x-transition class="md:hidden bg-white border-t border-gray-100">
                <nav class="flex flex-col px-4 py-4 space-y-3">
                    <a href="/" class="block text-gray-700 hover:text-green-700 font-medium py-2">Beranda</a>
                    <a href="/layanan/kepegawaian" class="block text-gray-700 hover:text-green-700 font-medium py-2">Kepegawaian</a>
                    <a href="{{ route('tracking') }}" class="block text-green-700 hover:text-green-900 font-bold py-2">Lacak Status Layanan</a>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 py-8">
             <div class="mb-4">
                 {{ $slot }}
             </div>
        </main>

        <footer class="bg-kemenag text-white py-6 mt-auto">
            <div class="container mx-auto px-4 text-center">
                <p class="text-sm opacity-90">&copy; {{ date('Y') }} PTSP FLASH - Kantor Kementerian Agama Kota Surabaya.</p>
                <p class="text-xs mt-1 text-gold">Ikhlas Beramal</p>
            </div>
        </footer>
    </body>
</html>
