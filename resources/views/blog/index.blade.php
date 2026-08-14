@extends('layouts.app')

@section('title', 'Blog & Berita - MI Manba\'ul Huda Sekaran')

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

    <!-- HERO BANNER -->
    <section class="bg-gradient-to-br from-slate-900 via-brand-900 to-slate-900 text-white py-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="text-xs font-bold text-gold-400 uppercase tracking-widest bg-gold-500/10 px-3 py-1 rounded-full border border-gold-500/20">Kabar & Literasi</span>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Blog & Berita Madrasah</h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Artikel seputar pendidikan anak, tips parenting islami, cerita kegiatan siswa, dan wawasan madrasah.
                </p>
                <!-- Breadcrumb -->
                <div class="flex items-center justify-center gap-2 text-xs text-slate-400 pt-2">
                    <a href="/" class="text-gold-300 transition">Beranda</a>
                    <span>/</span>
                    <span class="text-gold-400 font-semibold">Blog</span>
                </div>
            </div>
        </div>
    </section>

    <!-- SOROTAN UTAMA (ARTIKEL DISEMATKAN) -->
    @if($featuredBlog)
        <section class="py-12 bg-white border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-gradient-to-r from-slate-900 to-brand-900 rounded-3xl overflow-hidden shadow-2xl text-white grid md:grid-cols-12 items-center">
                    <div class="md:col-span-6 h-64 md:h-full relative bg-slate-800">
                        <img src="{{ Storage::url($featuredBlog->thumbnail) }}" class="w-full h-full object-cover">
                    </div>
                    <div class="md:col-span-6 p-8 sm:p-10 space-y-4">
                        <div class="flex items-center gap-3 text-xs text-gold-300">
                            <span class="bg-gold-500 text-slate-950 px-2.5 py-0.5 rounded-full font-bold">Sorotan Utama</span>
                            <span><i class="fa-regular fa-clock mr-1"></i> {{ $featuredBlog->created_at->format('d M Y') }}</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold leading-snug">{{ $featuredBlog->judul }}</h2>
                        <p class="text-slate-300 text-xs sm:text-sm line-clamp-3 leading-relaxed">{!! strip_tags($featuredBlog->konten) !!}</p>
                        <div class="pt-2">
                            <a href="{{ route('blog.show', $featuredBlog->slug) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gold-500 hover:bg-gold-600 text-slate-950 text-xs font-bold transition">
                                <span>Baca Artikel Selengkapnya</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ⚡ MAIN BLOG CONTENT WITH INSTANT ALPINE.JS ZERO-RELOAD FILTERING -->
    <section class="py-16 bg-white" x-data="{ searchQuery: '', selectedCategory: 'semua' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Status Badge saat Filter / Search Aktif -->
            <div x-show="searchQuery !== '' || selectedCategory !== 'semua'" x-transition class="mb-6 p-3 px-5 rounded-2xl bg-brand-50 border border-brand-200 text-xs font-semibold text-brand-800 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-filter text-gold-600"></i>
                    <span>Menampilkan hasil filter:</span>
                    <span x-show="selectedCategory !== 'semua'" class="bg-brand-700 text-white px-2.5 py-0.5 rounded-full font-bold" x-text="selectedCategory"></span>
                    <span x-show="searchQuery !== ''" class="italic text-slate-600">"<span x-text="searchQuery"></span>"</span>
                </div>
                <button @click="searchQuery = ''; selectedCategory = 'semua'" class="text-brand-700 hover:text-brand-900 underline font-bold">
                    Reset Filter
                </button>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 items-start">

                <!-- KIRI: DAFTAR ARTIKEL (DIFILTER INSTAN OLEH ALPINE.JS) -->
                <div class="lg:col-span-8 grid sm:grid-cols-2 gap-6">
                    @forelse($blogs as $blog)
                        @php
                            $catSlugs = $blog->kategoris->pluck('slug')->toArray();
                            $catSlugsJson = json_encode($catSlugs);
                            $judulLower = addslashes(strtolower($blog->judul));
                        @endphp

                        <div x-show="(selectedCategory === 'semua' || {{ $catSlugsJson }}.includes(selectedCategory)) && (searchQuery === '' || '{{ $judulLower }}'.includes(searchQuery.toLowerCase()))"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-soft hover:shadow-lg transition flex flex-col justify-between">
                            <div>
                                <div class="h-48 bg-slate-100 overflow-hidden relative">
                                    <img src="{{ Storage::url($blog->thumbnail) }}" class="w-full h-full object-cover">
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
                                <div class="p-5 space-y-2">
                                    <span class="text-[11px] text-slate-400 font-medium"><i class="fa-regular fa-clock mr-1"></i> {{ $blog->created_at->format('d M Y') }}</span>
                                    <h3 class="font-bold text-slate-900 text-base line-clamp-2">{{ $blog->judul }}</h3>
                                    <p class="text-xs text-slate-500 line-clamp-2">{!! strip_tags($blog->konten) !!}</p>
                                </div>
                            </div>
                            <div class="p-5 pt-0 border-t border-slate-100 mt-2">
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-xs font-bold text-brand-700 hover:text-brand-800 flex items-center gap-1">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 text-slate-500">
                            <p class="text-sm">Belum ada artikel blog.</p>
                        </div>
                    @endforelse
                </div>

                <!-- 📌 KANAN: SIDEBAR WIDGETS DENGAN INSTANT JAVASCRIPT/ALPINE.JS -->
                <div class="lg:col-span-4 space-y-6">

                    <!-- WIDGET 1: CARI ARTIKEL (Pill Input dengan Instant Search) -->
                    <div class="p-6 rounded-3xl bg-slate-50/80 border border-slate-200/80 shadow-soft space-y-4">
                        <h4 class="font-bold text-slate-900 text-base">Cari Artikel</h4>
                        <div class="relative">
                            <input type="text" x-model="searchQuery" placeholder="Kata kunci..." class="w-full pl-10 pr-4 py-3 rounded-full border border-slate-200 text-xs focus:outline-none focus:border-brand-700 bg-white shadow-sm placeholder:text-slate-400">
                            <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-slate-400 text-xs"></i>
                        </div>
                    </div>

                    <!-- WIDGET 2: KATEGORI TULISAN (Instant Category Filter Buttons) -->
                    <div class="p-6 rounded-3xl bg-slate-50/80 border border-slate-200/80 shadow-soft space-y-4">
                        <h4 class="font-bold text-slate-900 text-base border-b border-slate-200/80 pb-3">Kategori Tulisan</h4>

                        <div class="space-y-1">
                            <!-- Button 'Semua Kategori' -->
                            <button @click="selectedCategory = 'semua'"
                                    :class="selectedCategory === 'semua' ? 'text-brand-700 font-bold bg-brand-50/80 rounded-xl px-2.5' : 'text-slate-700 hover:text-brand-700'"
                                    class="flex justify-between items-center py-2.5 px-1 w-full transition text-xs font-medium border-b border-slate-100/80">
                                <span>Semua Kategori</span>
                                <span class="bg-brand-50 text-brand-700 font-bold px-2.5 py-0.5 rounded-md text-[11px]">{{ $blogs->count() }}</span>
                            </button>

                            <!-- Tombol Kategori Dinamis -->
                            @foreach($kategoriBlogs as $kat)
                                <button @click="selectedCategory = '{{ $kat->slug }}'"
                                        :class="selectedCategory === '{{ $kat->slug }}' ? 'text-brand-700 font-bold bg-brand-50/80 rounded-xl px-2.5' : 'text-slate-700 hover:text-brand-700'"
                                        class="flex justify-between items-center py-2.5 px-1 w-full transition text-xs font-medium border-b border-slate-100/80 last:border-b-0">
                                    <span>{{ $kat->nama }}</span>
                                    <span class="bg-brand-50 text-brand-700 font-bold px-2.5 py-0.5 rounded-md text-[11px]">{{ $kat->blogs_count ?? $kat->blogs()->count() }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

@endsection
