<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'PTSP Kemenag' }}</title>
        <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/9a/Kementerian_Agama_new_logo.png">
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

        <footer class="bg-kemenag text-white pt-16 pb-8 mt-auto border-t-4 border-yellow-500">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                    
                    <!-- About -->
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Kementerian_Agama_new_logo.png" alt="Logo Kemenag" class="h-16 w-auto bg-white rounded-lg p-1">
                            <div class="flex flex-col">
                                <span class="font-bold text-lg leading-tight">Kementerian Agama</span>
                                <span class="font-bold text-lg leading-tight">Kota Surabaya</span>
                            </div>
                        </div>
                        <p class="text-green-50 text-sm leading-relaxed opacity-90">
                            Mewujudkan masyarakat Surabaya yang taat beragama, rukun, cerdas, dan sejahtera lahir batin.
                        </p>
                        <div class="flex gap-4">
                            <a href="#" class="bg-white/10 hover:bg-yellow-500 hover:text-white p-2 rounded-lg transition-all duration-300 group">
                                <i data-lucide="facebook" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="bg-white/10 hover:bg-yellow-500 hover:text-white p-2 rounded-lg transition-all duration-300 group">
                                <i data-lucide="instagram" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="bg-white/10 hover:bg-yellow-500 hover:text-white p-2 rounded-lg transition-all duration-300 group">
                                <i data-lucide="youtube" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                            </a>
                            <a href="#" class="bg-white/10 hover:bg-yellow-500 hover:text-white p-2 rounded-lg transition-all duration-300 group">
                                <i data-lucide="twitter" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Tautan Cepat -->
                    <div>
                        <h4 class="text-xl font-bold text-yellow-400 mb-6">Tautan Cepat</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> Profil</a></li>
                            <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> Visi & Misi</a></li>
                            <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> Struktur Organisasi</a></li>
                            <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> Layanan Publik</a></li>
                            <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> PPID</a></li>
                            <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> Pengaduan</a></li>
                        </ul>
                    </div>

                    <!-- Layanan -->
                    <div>
                        <h4 class="text-xl font-bold text-yellow-400 mb-6">Layanan</h4>
                        <ul class="space-y-3 text-sm">
                            <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> Pendaftaran Haji</a></li>
                            <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> Sertifikasi Halal</a></li>
                            <li><a href="#" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> Penyuluhan Agama</a></li>
                            <li><a href="https://magang.kemenagsby.web.id/" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> Magang Kemenag Surabaya</a></li>
                            <li><a href="https://esurat.kemenagsby.web.id/" class="hover:text-yellow-400 transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-4 h-4 text-yellow-500/50"></i> E-Surat</a></li>
                        </ul>
                    </div>

                    <!-- Kontak -->
                    <div>
                        <h4 class="text-xl font-bold text-yellow-400 mb-6">Kontak Kami</h4>
                        <ul class="space-y-4 text-sm">
                            <li class="flex items-start gap-3">
                                <i data-lucide="map-pin" class="w-5 h-5 text-yellow-400 shrink-0 mt-0.5"></i>
                                <span class="leading-relaxed">Jl. Masjid Al-Akbar Timur No.4, Gayungan, Kec. Gayungan, Surabaya, Jawa Timur 60234</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i data-lucide="phone" class="w-5 h-5 text-yellow-400 shrink-0"></i>
                                <span>(031) 8285319</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i data-lucide="mail" class="w-5 h-5 text-yellow-400 shrink-0"></i>
                                <a href="mailto:admin@kemenagsby.go.id" class="hover:text-yellow-400 transition-colors">admin@kemenagsby.go.id</a>
                            </li>
                            <li class="flex items-start gap-3">
                                <i data-lucide="clock" class="w-5 h-5 text-yellow-400 shrink-0 mt-0.5"></i>
                                <div class="flex flex-col">
                                    <span>Senin - Kamis: 07:30 - 16:00 WIB</span>
                                    <span>Jumat: 07:30 - 16:30 WIB</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="border-t border-white/20 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center text-sm text-green-100 gap-4">
                    <p>&copy; {{ date('Y') }} Kementerian Agama Kota Surabaya. All rights reserved.</p>
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-yellow-400 transition-colors">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-yellow-400 transition-colors">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="https://unpkg.com/lucide@latest"></script>
        <script>
            lucide.createIcons();
        </script>
    </body>
</html>
