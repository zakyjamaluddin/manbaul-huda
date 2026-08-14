<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $globalProfil = \App\Models\Profil::with(['kaldikBlog', 'programUnggulanBlog', 'ekstrakurikulerBlog'])->first();
        $globalHero = \App\Models\HeroSection::first();

        $defaultTitle = $globalProfil->nama_madrasah ?? "MI Manba'ul Huda Sekaran";
        $defaultDescription = $globalHero->description ?? "Mewujudkan generasi yang berpegang teguh pada nilai keagamaan, unggul dalam IPTEK, dan peduli kelestarian lingkungan.";
        $defaultOgImage = !empty($globalProfil->og_image)
            ? Storage::url($globalProfil->og_image)
            : (!empty($globalProfil->logo) ? Storage::url($globalProfil->logo) : asset('images/default-og.jpg'));
    @endphp

    <title>@yield('title', $defaultTitle)</title>
    <meta name="title" content="@yield('title', $defaultTitle)">
    <meta name="description" content="@yield('meta_description', $defaultDescription)">

    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:title" content="@yield('og_title', $defaultTitle)">
    <meta property="og:description" content="@yield('og_description', $defaultDescription)">
    <meta property="og:image" content="@yield('og_image', $defaultOgImage)">

    <!-- Google Fonts, Tailwind, FontAwesome, Alpine.js CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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
                            700: '#13653f',
                            800: '#0e4a2e',
                            900: '#09311e',
                            dark: '#062013'
                        },
                        gold: {
                            100: '#fdf8e6',
                            300: '#f7df7b',
                            500: '#c5a059',
                            600: '#a8823f',
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

    <style>
    /* 📰 TATA LETAK TYPOGRAPHY ARTIKEL RICHTEXT FILAMENT */
    .article-content h1 {
        font-size: 1.875rem !important; /* 30px */
        line-height: 2.25rem !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin-top: 2rem !important;
        margin-bottom: 1rem !important;
        border-bottom: 2px solid #f1f5f9 !important;
        padding-bottom: 0.5rem !important;
    }
    .article-content h2 {
        font-size: 1.5rem !important; /* 24px */
        line-height: 2rem !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin-top: 1.75rem !important;
        margin-bottom: 0.875rem !important;
        border-bottom: 2px solid #e2e8f0 !important;
        padding-bottom: 0.375rem !important;
    }
    .article-content h3 {
        font-size: 1.25rem !important; /* 20px */
        line-height: 1.75rem !important;
        font-weight: 700 !important;
        color: #13653f !important; /* Hijau Emerald */
        margin-top: 1.5rem !important;
        margin-bottom: 0.75rem !important;
    }
    .article-content h4 {
        font-size: 1.125rem !important; /* 18px */
        line-height: 1.5rem !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        margin-top: 1.25rem !important;
        margin-bottom: 0.5rem !important;
    }
    .article-content p {
        margin-bottom: 1.25rem !important;
        line-height: 1.8 !important;
        color: #334155 !important;
    }

    /* 📜 KUTIPAN / BLOCKQUOTE MEWAH (BERWARNA HIJAU-EMAS) */
    .article-content blockquote {
        border-left: 5px solid #c5a059 !important; /* Emas */
        background-color: #f0fdf4 !important; /* Hijau Soft */
        padding: 1.25rem 1.5rem !important;
        margin-top: 1.75rem !important;
        margin-bottom: 1.75rem !important;
        border-top-right-radius: 1rem !important;
        border-bottom-right-radius: 1rem !important;
        font-family: 'Playfair Display', Georgia, serif !important;
        font-style: italic !important;
        font-size: 1.125rem !important;
        color: #0e4a2e !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
    }
    .article-content blockquote p {
        margin-bottom: 0 !important;
    }

    /* 🔢 LIST BULLETS & NUMBERING */
    .article-content ul {
        list-style-type: disc !important;
        padding-left: 1.5rem !important;
        margin-top: 1rem !important;
        margin-bottom: 1.25rem !important;
    }
    .article-content ol {
        list-style-type: decimal !important;
        padding-left: 1.5rem !important;
        margin-top: 1rem !important;
        margin-bottom: 1.25rem !important;
    }
    .article-content li {
        margin-bottom: 0.5rem !important;
        line-height: 1.6 !important;
    }
    .article-content strong, .article-content b {
        font-weight: 700 !important;
        color: #0f172a !important;
    }
    .article-content a {
        color: #13653f !important;
        font-weight: 700 !important;
        text-decoration: underline !important;
        text-underline-offset: 4px !important;
    }
    .article-content a:hover {
        color: #0e4a2e !important;
    }
</style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-brand-700 selection:text-white" x-data="{ mobileMenuOpen: false, activeTab: 'sejarah', modalOpen: false, modalContent: ''  }">

    <!-- TOP ANNOUNCEMENT BAR (DENGAN INSTAGRAM) -->
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
                    @if(!empty($globalProfil->link_instagram))
                        <a href="{{ $globalProfil->link_instagram }}" target="_blank" class="hover:text-gold-400 transition" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    @endif
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

    <!-- MAIN NAVBAR (5 MENU UTAMA + CTA PPDB) -->
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

                <!-- DESKTOP NAVIGATION (5 MENU) -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">

                    <!-- A. BERANDA -->
                    <a href="{{ route('home') }}" class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('home') ? 'text-brand-700 bg-brand-50' : 'text-slate-700 hover:text-brand-700' }} transition rounded-lg">
                        Beranda
                    </a>

                    <!-- B. PROFIL (DROPDOWN) -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-brand-700 transition rounded-lg flex items-center gap-1">
                            Profil <i class="fa-solid fa-chevron-down text-[10px] transition duration-200" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-transition class="absolute top-full left-0 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-2 mt-1 z-50">
                            <a href="{{ route('home') }}#sejarah" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 flex items-center gap-2">
                                <i class="fa-solid fa-clock-rotate-left text-xs text-gold-500 w-4"></i> Sejarah Singkat
                            </a>
                            <a href="{{ route('home') }}#visi-misi" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 flex items-center gap-2">
                                <i class="fa-solid fa-bullseye text-xs text-gold-500 w-4"></i> Visi & Misi
                            </a>
                            <a href="{{ route('home') }}#sambutan" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 flex items-center gap-2">
                                <i class="fa-solid fa-user-tie text-xs text-gold-500 w-4"></i> Sambutan Kepala
                            </a>
                        </div>
                    </div>

                    <!-- C. AKADEMIK & PROGRAM (DROPDOWN LINK KE BLOG) -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-brand-700 transition rounded-lg flex items-center gap-1">
                            Akademik & Program <i class="fa-solid fa-chevron-down text-[10px] transition duration-200" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-transition class="absolute top-full left-0 w-64 bg-white rounded-xl shadow-xl border border-slate-100 py-2 mt-1 z-50">
                            <a href="{{ isset($globalProfil->kaldikBlog) ? route('blog.show', $globalProfil->kaldikBlog->slug) : route('blog.index') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 flex items-center gap-2">
                                <i class="fa-solid fa-calendar-days text-xs text-gold-500 w-4"></i> Kalender Pendidikan (Kaldik)
                            </a>
                            <a href="{{ isset($globalProfil->programUnggulanBlog) ? route('blog.show', $globalProfil->programUnggulanBlog->slug) : route('blog.index') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 flex items-center gap-2">
                                <i class="fa-solid fa-star text-xs text-gold-500 w-4"></i> Program Unggulan
                            </a>
                            <a href="{{ isset($globalProfil->ekstrakurikulerBlog) ? route('blog.show', $globalProfil->ekstrakurikulerBlog->slug) : route('blog.index') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 flex items-center gap-2">
                                <i class="fa-solid fa-person-running text-xs text-gold-500 w-4"></i> Ekstrakurikuler & Keagamaan
                            </a>
                        </div>
                    </div>

                    <!-- D. KESISWAAN (DROPDOWN) -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="px-3 py-2 text-sm font-medium {{ request()->routeIs('kesiswaan.*') ? 'text-brand-700 bg-brand-50' : 'text-slate-700 hover:text-brand-700' }} transition rounded-lg flex items-center gap-1">
                            Kesiswaan <i class="fa-solid fa-chevron-down text-[10px] transition duration-200" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-transition class="absolute top-full left-0 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-2 mt-1 z-50">
                            <a href="{{ route('kesiswaan.prestasi') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 flex items-center gap-2">
                                <i class="fa-solid fa-trophy text-xs text-gold-500 w-4"></i> Prestasi Siswa
                            </a>
                            <a href="{{ route('kesiswaan.agenda') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 flex items-center gap-2">
                                <i class="fa-solid fa-bullhorn text-xs text-gold-500 w-4"></i> Agenda Madrasah
                            </a>
                            <a href="{{ route('kesiswaan.guru') }}" class="block px-4 py-2.5 text-sm text-slate-700 hover:bg-brand-50 hover:text-brand-700 flex items-center gap-2">
                                <i class="fa-solid fa-chalkboard-user text-xs text-gold-500 w-4"></i> Tenaga Pendidik & Guru
                            </a>
                        </div>
                    </div>

                    <!-- E. GALERI -->
                    <a href="{{ route('gallery') }}" class="px-3 py-2 text-sm font-semibold {{ request()->routeIs('gallery') ? 'text-brand-700 bg-brand-50' : 'text-slate-700 hover:text-brand-700' }} transition rounded-lg">
                        Galeri
                    </a>
                </nav>

                <!-- F. TOMBOL CTA PPDB (MENONJOL DI UJUNG KANAN) -->
                <div class="hidden lg:flex items-center gap-3">
                    <a href="{{ route('ppdb.index') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-brand-700 hover:bg-brand-800 rounded-full shadow-md hover:shadow-lg transition flex items-center gap-2 border border-gold-500/20">
                        <span>Pendaftaran (PPDB)</span>
                        <i class="fa-solid fa-arrow-right text-xs text-gold-300"></i>
                    </a>
                </div>

                <!-- MOBILE MENU BUTTON -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition">
                    <i class="fa-solid text-xl" :class="mobileMenuOpen ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    @yield('content')

    <!-- 🟢 FLOATING WHATSAPP BUTTON -->
    @php
        $rawWa = $globalProfil->nomor_whatsapp ?? '081234567890';
        $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        }
        $pesanWaFloat = "Assalamu'alaikum Warahmatullahi Wabarakatuh.\n\nYth. Admin " . ($globalProfil->nama_madrasah ?? "MI Manba'ul Huda Sekaran") . ",\nSaya ingin bertanya informasi seputar madrasah / PPDB. Terima kasih.";
        $linkWaFloat = "https://api.whatsapp.com/send?phone=" . $cleanWa . "&text=" . urlencode($pesanWaFloat);
    @endphp

    <div class="fixed bottom-6 right-6 z-50 flex items-center gap-3 group">
        <span class="hidden sm:inline-block px-3.5 py-2 rounded-2xl bg-slate-900/90 backdrop-blur text-white text-xs font-bold shadow-2xl opacity-0 group-hover:opacity-100 transition duration-300 border border-white/10">
            Hubungi WhatsApp Kami
        </span>
        <a href="{{ $linkWaFloat }}" target="_blank" aria-label="Chat WhatsApp Admin" class="relative w-14 h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center shadow-2xl hover:scale-110 active:scale-95 transition duration-300 border-2 border-white">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <i class="fa-brands fa-whatsapp text-2xl relative z-10"></i>
        </a>
    </div>

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
                </div>

                <div class="md:col-span-3 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white">Navigasi Cepat</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('home') }}" class="text-gold-300 transition">Beranda</a></li>
                        <li><a href="{{ route('kesiswaan.prestasi') }}" class="hover:text-gold-300 transition">Prestasi Siswa</a></li>
                        <li><a href="{{ route('kesiswaan.agenda') }}" class="hover:text-gold-300 transition">Agenda Madrasah</a></li>
                        <li><a href="{{ route('kesiswaan.guru') }}" class="hover:text-gold-300 transition">Tenaga Pendidik</a></li>
                        <li><a href="{{ route('ppdb.index') }}" class="hover:text-gold-300 transition">Pendaftaran Siswa Baru</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4 space-y-3">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-white">Lokasi & Kontak</h4>
                    <p class="text-xs text-slate-400 leading-relaxed">{{ $globalProfil->alamat }}</p>
                    <div class="flex items-center gap-3 pt-1">
                        @if(!empty($globalProfil->link_instagram))
                            <a href="{{ $globalProfil->link_instagram }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-gold-500 hover:text-slate-950 flex items-center justify-center text-xs transition"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if(!empty($globalProfil->link_fb))
                            <a href="{{ $globalProfil->link_fb }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-gold-500 hover:text-slate-950 flex items-center justify-center text-xs transition"><i class="fa-brands fa-facebook-f"></i></a>
                        @endif
                        @if(!empty($globalProfil->link_youtube))
                            <a href="{{ $globalProfil->link_youtube }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-gold-500 hover:text-slate-950 flex items-center justify-center text-xs transition"><i class="fa-brands fa-youtube"></i></a>
                        @endif
                        @if(!empty($globalProfil->link_tiktok))
                            <a href="{{ $globalProfil->link_tiktok }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-gold-500 hover:text-slate-950 flex items-center justify-center text-xs transition"><i class="fa-brands fa-tiktok"></i></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400 gap-4">
                <p>&copy; 2025 {{ $globalProfil->nama_madrasah ?? "MI Manba'ul Huda Sekaran Balen" }}. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>


       <!-- 🌐 SWIPER CDN & SCRIPT INIT -->
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
