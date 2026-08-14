<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $globalProfil = \App\Models\Profil::first();
        $globalHero = \App\Models\HeroSection::first();

        // 1. Meta Title bawaan dari Nama Madrasah
        $defaultTitle = $globalProfil->nama_madrasah ?? "MI Manba'ul Huda Sekaran";

        // 2. Meta Description bawaan dari Deskripsi di Tabel Hero
        $defaultDescription = $globalHero->description ?? "Mewujudkan generasi yang berpegang teguh pada nilai keagamaan, unggul dalam IPTEK, dan peduli kelestarian lingkungan.";

        // 3. OG Image bawaan dari Thumbnail Profil
        $defaultOgImage = !empty($globalProfil->og_image)
            ? Storage::url($globalProfil->og_image)
            : (!empty($globalProfil->logo) ? Storage::url($globalProfil->logo) : asset('images/default-og.jpg'));
    @endphp

    <!-- Primary Meta Tags -->
    <title>@yield('title', $defaultTitle)</title>
    <meta name="title" content="@yield('title', $defaultTitle)">
    <meta name="description" content="@yield('meta_description', $defaultDescription)">

    <!-- Open Graph / Facebook / WhatsApp SEO Tags -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:title" content="@yield('og_title', $defaultTitle)">
    <meta property="og:description" content="@yield('og_description', $defaultDescription)">
    <meta property="og:image" content="@yield('og_image', $defaultOgImage)">

    <!-- Twitter Meta Tags -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ request()->fullUrl() }}">
    <meta property="twitter:title" content="@yield('og_title', $defaultTitle)">
    <meta property="twitter:description" content="@yield('og_description', $defaultDescription)">
    <meta property="twitter:image" content="@yield('og_image', $defaultOgImage)">

    <!-- Google Fonts, Tailwind & FontAwesome CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            500: '#16a34a',
                            600: '#15803d',
                            700: '#13653f',
                            800: '#0e4a2e',
                            900: '#09311e',
                            dark: '#062013'
                        },
                        gold: {
                            100: '#fdf8e6',
                            200: '#fbeeb3',
                            300: '#f7df7b',
                            400: '#f1cb45',
                            500: '#c5a059',
                            600: '#a8823f',
                            700: '#84622b',
                            hover: '#b08c43'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif']
                    }
                }
            }
        }
    </script>
    <style>
        .islamic-pattern {
            background-color: #ffffff;
            background-image: radial-gradient(#13653f 0.5px, transparent 0.5px), radial-gradient(#13653f 0.5px, #ffffff 0.5px);
            background-size: 20px 20px;
            background-position: 0 0,10px 10px;
            opacity: 0.03;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-brand-700 selection:text-white" x-data="{ mobileMenuOpen: false, activeTab: 'sejarah', modalOpen: false, modalContent: ''  }">

    @php
        $globalProfil = \App\Models\Profil::first();
    @endphp

    <!-- TOP ANNOUNCEMENT BAR -->
    <div class="bg-brand-900 text-white text-xs py-2 px-4 border-b border-brand-800">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-1.5 font-medium text-gold-300">
                    <i class="fa-solid fa-graduation-cap"></i> PPDB T.A. 2025/2026 Telah Dibuka!
                </span>
            </div>
            <div class="flex items-center gap-6">
                <a href="mailto:{{ $globalProfil->email ?? 'mi.manbaulhuda1933@gmail.com' }}" class="hover:text-gold-300 transition flex items-center gap-1.5">
                    <i class="fa-regular fa-envelope text-gold-400"></i> {{ $globalProfil->email ?? 'mi.manbaulhuda1933@gmail.com' }}
                </a>
                <span class="text-brand-700">|</span>
                <div class="flex items-center gap-3">
                    @if(!empty($globalProfil->link_fb))
                        <a href="{{ $globalProfil->link_fb }}" target="_blank" class="hover:text-gold-400 transition" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if(!empty($globalProfil->link_youtube))
                        <a href="{{ $globalProfil->link_youtube }}" target="_blank" class="hover:text-gold-400 transition" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    @endif
                    @if(!empty($globalProfil->link_tiktok))
                        <a href="{{ $globalProfil->link_tiktok }}" target="_blank" class="hover:text-gold-400 transition" title="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR (STUCK TOP) -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- LOGO & SCHOOL NAME -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    @if(!empty($globalProfil->logo))
                        <img src="{{ Storage::url($globalProfil->logo) }}" alt="Logo" class="w-12 h-12 object-contain group-hover:scale-105 transition">
                    @else
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-700 to-brand-900 flex items-center justify-center text-white shadow-md border border-gold-500/30">
                            <i class="fa-solid fa-mosque text-xl text-gold-300"></i>
                        </div>
                    @endif
                    <div>
                        <div class="font-bold text-lg leading-snug tracking-tight text-slate-900 group-hover:text-brand-700 transition">
                            {{ $globalProfil->nama_madrasah ?? "MI MANBA'UL HUDA" }}
                        </div>
                        <p class="text-[11px] text-slate-500 font-medium tracking-wide">Sekaran, Balen, Bojonegoro</p>
                    </div>
                </a>

                <!-- DESKTOP NAVIGATION -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 text-sm font-semibold {{ request()->routeIs('home') ? 'text-brand-700 bg-brand-50' : 'text-slate-700 hover:text-brand-700' }} transition rounded-lg">
                        Beranda
                    </a>

                    <!-- PROFIL DROPDOWN -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="px-3.5 py-2 text-sm font-medium text-slate-700 hover:text-brand-700 transition rounded-lg flex items-center gap-1.5">
                            Profil <i class="fa-solid fa-chevron-down text-[10px] transition duration-200" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-transition class="absolute top-full left-0 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-2 mt-1 z-50">
                            <a href="{{ route('home') }}#sambutan" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition flex items-center gap-2">
                                <i class="fa-solid fa-user-tie text-xs text-gold-500 w-4"></i> Sambutan Kepala
                            </a>
                            <a href="{{ route('home') }}#sejarah" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition flex items-center gap-2">
                                <i class="fa-solid fa-clock-rotate-left text-xs text-gold-500 w-4"></i> Sejarah Madrasah
                            </a>
                            <a href="{{ route('home') }}#visi-misi" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 transition flex items-center gap-2">
                                <i class="fa-solid fa-bullseye text-xs text-gold-500 w-4"></i> Visi & Misi
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('home') }}#prestasi" class="px-3.5 py-2 text-sm font-medium text-slate-700 hover:text-brand-700 transition rounded-lg">
                        Prestasi
                    </a>

                    <!-- PENGUMUMAN WITH PULSING DOT -->
                    <a href="{{ route('pengumuman') }}" class="px-3.5 py-2 text-sm font-semibold {{ request()->routeIs('pengumuman') ? 'text-brand-700 bg-brand-50' : 'text-slate-700 hover:text-brand-700' }} transition rounded-lg relative inline-flex items-center">
                        <span>Pengumuman</span>
                        <span class="absolute -top-0.5 -right-0.5 flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-amber-500"></span>
                        </span>
                    </a>

                    <a href="{{ route('gallery') }}" class="px-3.5 py-2 text-sm font-semibold {{ request()->routeIs('gallery') ? 'text-brand-700 bg-brand-50' : 'text-slate-700 hover:text-brand-700' }} transition rounded-lg">
                        Gallery
                    </a>

                    <a href="{{ route('blog.index') }}" class="px-3.5 py-2 text-sm font-semibold {{ request()->routeIs('blog.*') ? 'text-brand-700 bg-brand-50' : 'text-slate-700 hover:text-brand-700' }} transition rounded-lg">
                        Blog
                    </a>
                </nav>

                <!-- CTA BUTTON PPDB -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('ppdb.index') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-brand-700 hover:bg-brand-800 rounded-full shadow-md hover:shadow-lg transition flex items-center gap-2 border border-gold-500/20">
                        <span>Pendaftaran Siswa Baru</span>
                        <i class="fa-solid fa-arrow-right text-xs text-gold-300"></i>
                    </a>
                </div>

                <!-- MOBILE MENU BUTTON -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
                    <i class="fa-solid text-xl" :class="mobileMenuOpen ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        <!-- MOBILE MENU DRAWER -->
        <div x-show="mobileMenuOpen" x-collapse class="lg:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg font-semibold text-brand-700 bg-brand-50">Beranda</a>
            <a href="{{ route('pengumuman') }}" class="block px-3 py-2 rounded-lg text-slate-700">Pengumuman</a>
            <a href="{{ route('gallery') }}" class="block px-3 py-2 rounded-lg text-slate-700">Gallery</a>
            <a href="{{ route('blog.index') }}" class="block px-3 py-2 rounded-lg text-slate-700">Blog</a>
            <a href="{{ route('ppdb.index') }}" class="block w-full text-center px-4 py-3 text-sm font-semibold text-white bg-brand-700 rounded-xl">Pendaftaran Siswa Baru (PPDB)</a>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    @yield('content')

    <!-- FOOTER -->
    <footer class="bg-brand-dark text-slate-300 py-12 border-t border-brand-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-12 gap-8 pb-10 border-b border-brand-800/80">
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brand-700 flex items-center justify-center text-white border border-gold-500/40">
                            <i class="fa-solid fa-mosque text-lg text-gold-300"></i>
                        </div>
                        <span class="font-bold text-lg text-white">{{ $globalProfil->nama_madrasah ?? "MI MANBA'UL HUDA" }}</span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                        Lembaga Pendidikan Ma'rif NU berprestasi yang berkomitmen membina akhlaqul karimah, intelektual, dan kesadaran lingkungan di Sekaran Balen Bojonegoro.
                    </p>
                    <p class="text-xs font-serif italic text-gold-400">
                        "{{ $globalProfil->tagline ?? 'Ora Ninggal Tuntunan lan Ora Ketinggalan Zaman' }}"
                    </p>
                </div>

                <div class="md:col-span-3 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white">Navigasi Cepat</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('home') }}" class="text-gold-300 transition">Beranda</a></li>
                        <li><a href="{{ route('pengumuman') }}" class="hover:text-gold-300 transition">Pengumuman</a></li>
                        <li><a href="{{ route('gallery') }}" class="hover:text-gold-300 transition">Gallery Foto</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-gold-300 transition">Blog & Berita</a></li>
                        <li><a href="{{ route('ppdb.index') }}" class="hover:text-gold-300 transition">Pendaftaran Siswa Baru</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white">Lokasi Madrasah</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        {{ $globalProfil->alamat ?? 'Kompleks Masjid Raudlatul Huda RT. 05 RW. 01 Desa Sekaran Kec. Balen Kab. Bojonegoro' }}
                    </p>
                    @if(!empty($globalProfil->link_gmaps))
                        <a href="{{ $globalProfil->link_gmaps }}" target="_blank" class="inline-block px-4 py-2 rounded-xl bg-white/10 hover:bg-gold-500 hover:text-slate-950 text-xs font-bold text-gold-300 transition border border-gold-500/30">
                            <i class="fa-solid fa-map-location-dot mr-1"></i> Petunjuk Arah Google Maps
                        </a>
                    @endif
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400 gap-4">
                <p>&copy; 2025 {{ $globalProfil->nama_madrasah ?? "MI Manba'ul Huda Sekaran Balen" }}. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- 🟢 FLOATING WHATSAPP BUTTON (POJOK KANAN BAWAH) -->
    @php
        // Ambil nomor WA dari database $globalProfil, bersihkan karakter non-angka
        $rawWa = $globalProfil->nomor_whatsapp ?? '081234567890';
        $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);

        // Ubah awalan 08xxx menjadi 628xxx untuk format WhatsApp internasional
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        }

        $pesanWaFloat = "Assalamu'alaikum Warahmatullahi Wabarakatuh.\n\nYth. Admin " . ($globalProfil->nama_madrasah ?? "MI Manba'ul Huda Sekaran") . ",\nSaya ingin bertanya informasi seputar madrasah / pendaftaran PPDB. Terima kasih.";
        $linkWaFloat = "https://api.whatsapp.com/send?phone=" . $cleanWa . "&text=" . urlencode($pesanWaFloat);
    @endphp

    <div class="fixed bottom-6 right-6 z-50 flex items-center gap-3 group">
        <!-- Tooltip Teks saat Kursor diarahkan (Hover) -->
        <span class="hidden sm:inline-block px-3.5 py-2 rounded-2xl bg-slate-900/90 backdrop-blur text-white text-xs font-bold shadow-2xl opacity-0 group-hover:opacity-100 transition duration-300 transform translate-x-2 group-hover:translate-x-0 border border-white/10">
            Hubungi WhatsApp Kami
        </span>

        <!-- Tombol Hijau Mengambang -->
        <a href="{{ $linkWaFloat }}" target="_blank" aria-label="Chat WhatsApp Admin" class="relative w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center shadow-2xl hover:scale-110 active:scale-95 transition duration-300 border-2 border-white">
            <!-- Animasi Gelombang Berkedip (Pulsing Wave) -->
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>

            <!-- Ikon WhatsApp -->
            <i class="fa-brands fa-whatsapp text-2xl relative z-10"></i>
        </a>
    </div>


    <!-- 🌐 SWIPER CDN & SCRIPT INIT -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.gallery-swiper', {
            slidesPerView: 1,
            spaceBetween: 16,
            loop: true,
            autoplay: {
                delay: 3000, // Bergeser otomatis setiap 3 detik
                disableOnInteraction: false,
                pauseOnMouseEnter: true, // Berhenti sementara saat kursor di atas foto
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '#gallery-next',
                prevEl: '#gallery-prev',
            },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 4, spaceBetween: 24 }
            }
        });
    });
</script>
</body>
</html>
