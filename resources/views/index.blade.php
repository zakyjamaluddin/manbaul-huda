@extends('layouts.app')

@section('title', 'MI Manba\'ul Huda - Ora Ninggal Tuntunan lan Ora Ketinggalan Zaman')

@section('content')
@php
    // Fungsi Helper Dinamis untuk Menentukan Warna Badge Kategori
    function getCategoryBadgeColor($categoryName) {
        $colors = [
            'bg-amber-100 text-amber-800 border-amber-200',
            'bg-blue-100 text-blue-800 border-blue-200',
            'bg-emerald-100 text-emerald-800 border-emerald-200',
            'bg-rose-100 text-rose-800 border-rose-200',
            'bg-teal-100 text-teal-800 border-teal-200',
            'bg-indigo-100 text-indigo-800 border-indigo-200',
            'bg-yellow-100 text-yellow-800 border-yellow-200',
        ];

        // Hitung nilai unik dari string nama kategori & lakukan modulo
        $index = abs(crc32($categoryName)) % count($colors);

        return $colors[$index];
    }
@endphp

    <!-- HERO SECTION -->
    <section id="beranda" class="relative py-12 lg:py-20 overflow-hidden bg-white">
        <div class="absolute inset-0 islamic-pattern pointer-events-none"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-100/50 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-gold-100/40 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <div class="lg:col-span-7 space-y-6 text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-50 border border-brand-200/60 text-brand-700 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-gold-500"></span> Selamat Datang di Portal Resmi
                    </div>

                    <div class="space-y-3">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                            {{ $hero->header_1 ?? "MI Manba'ul Huda" }} <br>
                            <span class="text-brand-700">{{ $hero->header_2 ?? "Sekaran Balen Bojonegoro" }}</span>
                        </h1>
                        <div class="p-4 rounded-2xl bg-gradient-to-r from-brand-900 to-brand-800 text-white shadow-lg border-l-4 border-gold-500 my-4">
                            <p class="text-xs uppercase tracking-widest text-gold-300 font-bold mb-1">Motto Utama Madrasah</p>
                            <p class="font-serif italic text-lg sm:text-xl text-amber-100">
                                "{{ $profil->tagline ?? 'Ora Ninggal Tuntunan lan Ora Ketinggalan Zaman' }}"
                            </p>
                        </div>
                    </div>

                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                        {{ $hero->description ?? 'Mewujudkan generasi yang berpegang teguh pada nilai keagamaan, unggul dalam ilmu pengetahuan dan teknologi, serta peduli terhadap kelestarian lingkungan.' }}
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="#visi-misi" class="px-7 py-3.5 rounded-xl font-bold text-white bg-brand-700 hover:bg-brand-800 shadow-lg shadow-brand-700/25 flex items-center gap-2">
                            <span>Kenal Lebih Dekat</span>
                            <i class="fa-solid fa-arrow-right text-xs text-gold-300"></i>
                        </a>
                        {{-- <a href="#visi-misi" class="px-6 py-3.5 rounded-xl font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 flex items-center gap-2 border border-slate-200">
                            <span>Lihat Visi & Misi</span>
                            <i class="fa-regular fa-compass text-xs text-brand-700"></i>
                        </a> --}}
                    </div>
                </div>

                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <div class="relative bg-white p-3 rounded-3xl shadow-2xl border border-slate-100 overflow-hidden">
                            <div class="relative h-[380px] sm:h-[420px] rounded-2xl overflow-hidden bg-slate-900 group">
                                @if(!empty($hero->image))

                                    <img src="{{ Storage::url($hero->image) }}" alt="Hero Image" class="w-full h-full object-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/50 text-xs font-bold text-brand-800 shadow">
                                    <i class="fa-solid fa-certificate text-gold-500 mr-1"></i> LP Ma'rif NU
                                </div>
                                <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-slate-100 shadow-lg text-slate-800">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-xs font-bold uppercase tracking-wider text-brand-700">Madrasah Ibtidaiyah</span>
                                        <span class="text-[10px] bg-gold-100 text-gold-700 px-2 py-0.5 rounded-full font-bold">Est. 1933 M</span>
                                    </div>
                                    <p class="text-sm font-bold text-slate-900">Sekaran, Kec. Balen, Bojonegoro</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Berdiri Sejak 02 Shofar 1352 H / 27 Mei 1933 M</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION WHY US -->
    <section class="py-16 bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8 items-center mb-10">
                <div class="lg:col-span-5">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                        Mengapa Memilih <br><span class="text-brand-700">{{ $profil->nama_madrasah ?? "MI Manba'ul Huda?" }}</span>
                    </h2>
                    <p class="text-slate-600 text-sm mt-2">
                        Kami menghadirkan lingkungan belajar kondusif dengan kurikulum berkualitas, bimbingan islami, dan lingkungan ramah anak.
                    </p>
                    <a href="#visi-misi" class="inline-flex items-center gap-2 text-sm font-bold text-brand-700 hover:text-brand-800 mt-4 group">
                        <span>Tentang Kami</span>
                        <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition duration-200"></i>
                    </a>
                </div>

                <div class="lg:col-span-7 grid sm:grid-cols-2 gap-4">
                    @foreach($whyUs as $item)
                        <div class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-soft">
                            <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center mb-3">
                                <i class="fa-solid fa-{{ $item->icon }} text-lg"></i>
                            </div>
                            <h3 class="font-bold text-slate-900 text-base mb-1">{{ $item->title }}</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">{{ $item->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- SAMBUTAN KEPALA MADRASAH (ELEGAN TANPA FOTO) -->
    <section id="sambutan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-slate-900 via-brand-900 to-slate-900 rounded-3xl p-8 sm:p-12 text-white shadow-2xl border border-gold-500/30">
                <div class="relative z-10 max-w-4xl mx-auto space-y-6">
                    <div class="flex items-center justify-between border-b border-white/10 pb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-gold-500/20 text-gold-400 flex items-center justify-center text-xl border border-gold-500/30">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-gold-400 uppercase tracking-widest block">Sambutan Resmi</span>
                                <h2 class="text-2xl sm:text-3xl font-extrabold text-white">Kepala {{ $profil->nama_madrasah ?? "MI Manba'ul Huda" }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="prose prose-invert max-w-none text-slate-300 text-sm sm:text-base leading-relaxed">
                        {!! $profil->sambutan_kepala ?? '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh...</p>' !!}
                    </div>

                    <div class="pt-6 border-t border-white/10 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-brand-800 text-gold-300 flex items-center justify-center font-bold text-sm border border-gold-500/30">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-white">{{ $profil->nama_kepala_madrasah ?? "Burhanuddin, S.Sos." }}</h4>
                            <p class="text-xs text-gold-400">Kepala Madrasah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- SECTION: TABBED PROFIL -->
    <section id="visi-misi" class="py-16 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold text-gold-600 uppercase tracking-widest bg-gold-100 px-3 py-1 rounded-full">Profil Lembaga</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Visi, Misi & Sejarah Singkat</h2>
                <p class="text-slate-600 text-sm mt-2">Mengenal lebih dekat pondasi moral, arah tujuan, dan perjalanan panjang pendirian MI Manba'ul Huda Sekaran.</p>
            </div>

            <div class="flex justify-center border-b border-slate-200 mb-8 max-w-2xl mx-auto">
                <button @click="activeTab = 'visi'" :class="{ 'border-brand-700 text-brand-700 font-bold border-b-2': activeTab === 'visi', 'text-slate-500 hover:text-slate-800': activeTab !== 'visi' }" class="py-3 px-6 text-sm transition">
                    Visi & Misi
                </button>
                <button @click="activeTab = 'sejarah'" :class="{ 'border-brand-700 text-brand-700 font-bold border-b-2': activeTab === 'sejarah', 'text-slate-500 hover:text-slate-800': activeTab !== 'sejarah' }" class="py-3 px-6 text-sm transition">
                    Sejarah Singkat
                </button>
                <button @click="activeTab = 'motto'" :class="{ 'border-brand-700 text-brand-700 font-bold border-b-2': activeTab === 'motto', 'text-slate-500 hover:text-slate-800': activeTab !== 'motto' }" class="py-3 px-6 text-sm transition">
                    Motto & Value
                </button>
            </div>

            <div class="max-w-4xl mx-auto">
                <div x-show="activeTab === 'visi'" class="space-y-8">
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-soft">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 rounded-lg bg-gold-100 text-gold-700 flex items-center justify-center font-bold">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Visi Madrasah</h3>
                        </div>
                        <p class="text-base sm:text-lg text-slate-800 font-medium leading-relaxed bg-brand-50/60 p-4 rounded-xl border border-brand-100">
                            "{{ $profil->visi ?? 'Terwujudnya Lulusan yang berpegang teguh pada ajaran agama serta unggul dalam Prestasi, dan Peduli terhadap Lingkungan' }}"
                        </p>
                    </div>

                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-soft">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-700 flex items-center justify-center font-bold">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Misi Madrasah</h3>
                        </div>
                        <div class="grid sm:grid-cols-2 gap-4">
                             @php
                                $misiArray = is_array($profil->misi ?? null) ? $profil->misi : json_decode($profil->misi ?? '[]', true);
                                $i = 1;
                            @endphp
                            @if(!empty($misiArray))

                                @foreach($misiArray as $misiItem)

                                    <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                                        <span class="w-6 h-6 rounded-full bg-brand-700 text-white text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">{{ $i++ }}</span>
                                        <p class="text-xs sm:text-sm text-slate-700">{{ is_array($misiItem) ? ($misiItem['poin_misi'] ?? '') : $misiItem }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div id="sejarah" x-show="activeTab === 'sejarah'" class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-soft space-y-4">
                    <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-landmark"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">Sejarah Berdirinya MI Manba'ul Huda</h3>
                            <p class="text-xs text-slate-500">Sekaran Balen Bojonegoro (27 Mei 1933 M - Sekarang)</p>
                        </div>
                    </div>
                    <div class="text-slate-700 text-sm leading-relaxed space-y-3">
                        <article class="prose prose-slate max-w-none space-y-3  sm:text-base leading-relaxed">
                            {!! $profil->sejarah_singkat !!}
                        </article>
                    </div>
                </div>

                <div x-show="activeTab === 'motto'" class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-soft text-center space-y-6">
                    <div class="w-16 h-16 rounded-full bg-gold-100 text-gold-700 mx-auto flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-quote-right"></i>
                    </div>
                    <div class="space-y-2">
                        <span class="text-xs font-bold text-gold-600 uppercase tracking-widest">Motto Perjuangan</span>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-serif italic">
                            "{{ $profil->tagline ?? 'Ora Ninggal Tuntunan lan Ora Ketinggalan Zaman' }}"
                        </h3>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION PRESTASI -->
    <section id="prestasi" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <span class="text-xs font-bold text-brand-700 uppercase bg-brand-50 px-3 py-1 rounded-full">Kebanggaan Kita</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Prestasi Peserta Didik</h2>
                </div>
                <a href="/kesiswaan/prestasi" class="mt-4 md:mt-0 text-sm font-bold text-brand-700 hover:text-brand-800">
                    Lihat Semua Prestasi &rarr;
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($prestasis as $prestasi)
                    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-soft">
                        <div class="relative h-48 bg-slate-100 overflow-hidden">
                            <img src="{{ Storage::url($prestasi->foto) }}" class="w-full h-full object-cover">
                            <div class="absolute top-3 left-3 bg-gold-500 text-slate-950 font-extrabold text-[11px] px-2.5 py-1 rounded-lg">
                                {{ $prestasi->prestasi }}
                            </div>
                        </div>
                        <div class="p-5 space-y-2">
                            <h3 class="font-bold text-slate-900 text-base">{{ $prestasi->judul }}</h3>
                            <p class="text-xs text-slate-600 line-clamp-2">{{ $prestasi->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION GALERI WITH AUTO-SLIDER CAROUSEL -->
    <section id="galeri" class="py-20 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
                <div>
                    <span class="text-xs font-bold text-brand-700 uppercase tracking-widest bg-brand-50 px-3 py-1 rounded-full">Dokumentasi</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Gallery & Aktivitas Madrasah</h2>
                    <p class="text-slate-600 text-sm mt-1">Momen kebersamaan, ragam ekstrakurikuler, dan suasana pembelajaran di madrasah.</p>
                </div>

                <!-- Tombol Navigasi Panah Kiri & Kanan -->
                <div class="flex items-center gap-2 mt-4 md:mt-0">
                    <button id="gallery-prev" class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-brand-700 hover:text-white hover:border-brand-700 shadow-sm transition flex items-center justify-center">
                        <i class="fa-solid fa-chevron-left text-sm"></i>
                    </button>
                    <button id="gallery-next" class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-brand-700 hover:text-white hover:border-brand-700 shadow-sm transition flex items-center justify-center">
                        <i class="fa-solid fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- SWIPER CAROUSEL TRACK -->
            <div class="swiper gallery-swiper py-2">
                <div class="swiper-wrapper">
                    @foreach($galeris as $galeri)
                        <div class="swiper-slide">
                            <div class="relative group overflow-hidden rounded-2xl shadow-soft bg-slate-900 h-64 cursor-pointer">
                                <img src="{{ Storage::url($galeri->foto) }}" alt="{{ $galeri->judul }}" class="w-full h-full object-cover opacity-90 group-hover:scale-110 transition duration-500">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 group-hover:opacity-100 transition flex flex-col justify-end p-4">
                                    @if($galeri->kategoris->isNotEmpty())
                                        @php
                                            $katNama = $galeri->kategoris->first()->nama;
                                            $badgeColorClass = getCategoryBadgeColor($katNama);
                                        @endphp

                                        <span class=" absolute mb-10 text-[10px] font-bold px-2 py-0.5 rounded-full border shadow-sm {{ $badgeColorClass }}">
                                            {{ $katNama }}
                                        </span>
                                    @endif
                                    <h3 class="text-sm font-bold text-white leading-snug">{{ $galeri->judul }}</h3>
                                    <p class="text-[11px] text-gold-300 mt-0.5"><i class="fa-regular fa-calendar mr-1"></i> {{ $galeri->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Titik Paginasi Swiper -->
                <div class="swiper-pagination !relative !bottom-0 mt-8"></div>
            </div>

            <!-- BUTTON LIHAT SEMUA GALLERY -->
            <div class="text-center mt-10">
                <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2.5 px-8 py-3.5 rounded-xl font-bold text-white bg-brand-700 hover:bg-brand-800 shadow-lg border border-gold-500/20 hover:scale-[1.02] transition duration-200">
                    <i class="fa-solid fa-images text-gold-300"></i>
                    <span>Lihat Semua Gallery Dokumentasi</span>
                    <i class="fa-solid fa-arrow-right text-xs text-gold-300"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- SECTION: PENGUMUMAN & BERITA -->
    <section id="pengumuman" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <div>
                    <div class="inline-flex items-center gap-2">
                        <span class="text-xs font-bold text-amber-800 bg-amber-100 px-3 py-1 rounded-full">Informasi Terkini</span>
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                        </span>
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Pengumuman & Berita Terbaru</h2>
                </div>
                <a href="/blog" class="mt-4 md:mt-0 text-sm font-bold text-brand-700 hover:text-brand-800">
                    Lihat Semua Artikel &rarr;
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($blogs as $blog)
                <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-soft hover:shadow-lg transition">
                    <div class="h-40 bg-slate-100 overflow-hidden relative">
                        <img src="{{ Storage::url($blog->thumbnail) ?? 'https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=1000&auto=format&fit=crop'}}" alt="{{$blog->judul}}" class="w-full h-full object-cover">
                        @if($blog->kategoris->isNotEmpty())
                            @php
                                $katNama = $blog->kategoris->first()->nama;
                                $badgeColorClass = getCategoryBadgeColor($katNama);
                            @endphp

                            <span class="absolute top-3 left-3 text-[10px] font-bold px-2.5 py-0.5 rounded-full border shadow-sm {{ $badgeColorClass }}">
                                {{ $katNama }}
                            </span>
                        @endif
                    </div>
                    <div class="p-4 space-y-2">
                        <span class="text-[11px] text-slate-400 font-medium"><i class="fa-regular fa-clock mr-1"></i> {{ $blog->created_at->format('d M Y') }}</span>
                        <h3 class="font-bold text-slate-900 text-sm line-clamp-2">{{ $blog->judul }}</h3>
                        <p class="text-xs text-slate-500 line-clamp-2">{{ strip_tags($blog->konten) }}</p>
                    </div>
                    <div class="p-5 pt-3 border-t border-slate-100 mt-2">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-xs font-bold text-brand-700 hover:text-brand-800 flex items-center gap-1">
                                Baca Selengkapnya &rarr;
                            </a>
                        </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- HUBUNGI KAMI & GOOGLE MAPS -->
    <section id="ppdb" class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 items-stretch">
                <div class="lg:col-span-5 space-y-6">
                    <span class="text-xs font-bold text-gold-400 uppercase bg-gold-500/10 border border-gold-500/30 px-3 py-1 rounded-full">Lokasi</span>
                    <h2 class="text-3xl font-extrabold text-white">Hubungi {{ $profil->nama_madrasah ?? "MI Manba'ul Huda" }}</h2>
                    <p class="text-slate-400 text-sm leading-relaxed">
                            Kami siap memberikan informasi selengkapnya terkait pendaftaran, program madrasah, dan layanan pendidikan. Silakan hubungi kami atau kunjungi lokasi madrasah.
                    </p>
                    <div class="space-y-4 pt-2">
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 hover:border-gold-500/40 transition">
                                <div class="w-10 h-10 rounded-xl bg-gold-500/20 text-gold-400 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-location-dot text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-white">Alamat Lengkap</h4>
                                    <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                                        {{$profil->alamat ?? 'Jl. Raya Sekaran No. 123, Kec. Balen, Kab. Bojonegoro, Jawa Timur'}}
                                    </p>
                                    <a href="{{ $profil->link_gmaps ?? 'https://maps.app.goo.gl/e1CY6ikMpqTNdFvm9' }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-gold-400 hover:text-gold-300 mt-2">
                                        <span>Buka di Aplikasi Google Maps</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10 hover:border-gold-500/40 transition">
                                <div class="w-10 h-10 rounded-xl bg-brand-500/20 text-brand-400 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-envelope text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-white">Email Resmi</h4>
                                    <a href="mailto:{{ $profil->email ?? 'mi.manbaulhuda1933@gmail.com' }}" class="text-xs text-slate-300 hover:text-gold-300 transition">
                                        {{ $profil->email ?? 'mi.manbaulhuda1933@gmail.com' }}
                                    </a>
                                </div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/5 border border-white/10 space-y-2">
                                <h4 class="font-bold text-xs uppercase tracking-wider text-gold-400">Media Sosial Resmi</h4>
                                <div class="flex flex-wrap gap-2 pt-1">
                                    <a href="{{ $profil->link_tiktok ?? 'https://www.tiktok.com/@mi.mhsekaran?_r=1&_t=ZS-98UlbWlsmHs' }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-white/10 hover:bg-gold-500 hover:text-slate-950 text-xs font-semibold text-slate-200 transition flex items-center gap-2">
                                        <i class="fa-brands fa-tiktok text-sm"></i> TikTok
                                    </a>
                                    <a href="{{ $profil->link_facebook ?? 'https://www.facebook.com/profile.php?id=61592675972219' }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-white/10 hover:bg-gold-500 hover:text-slate-950 text-xs font-semibold text-slate-200 transition flex items-center gap-2">
                                        <i class="fa-brands fa-facebook-f text-sm"></i> Facebook
                                    </a>
                                    <a href="{{ $profil->link_instagram ?? 'https://www.instagram.com/mi.mhsekaran' }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-white/10 hover:bg-gold-500 hover:text-slate-950 text-xs font-semibold text-slate-200 transition flex items-center gap-2">
                                        <i class="fa-brands fa-instagram text-sm"></i> Instagram
                                    </a>


                                    <a href="{{ $profil->link_youtube ?? 'https://www.youtube.com/@mimanbaulhudasekaranbalen5038/posts' }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-white/10 hover:bg-gold-500 hover:text-slate-950 text-xs font-semibold text-slate-200 transition flex items-center gap-2">
                                        <i class="fa-brands fa-youtube text-sm"></i> YouTube
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="lg:col-span-7 bg-white p-3 rounded-3xl shadow-2xl border border-white/10 min-h-[400px]">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.7743221369883!2d111.94296717411035!3d-7.152072270162943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e778151455acb55%3A0x5d69945cdb06829d!2sMI%20Manba'ul%20Huda!5e0!3m2!1sen!2sid!4v1786168568082!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" class="w-full h-full min-h-[400px] border-0 rounded-2xl" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

@endsection
