@extends('layouts.app')

@section('title', 'Galeri Dokumentasi - MI Manba\'ul Huda Sekaran')

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
    <section class="bg-gradient-to-br from-slate-900 via-brand-900 to-slate-900 text-white py-16 text-center relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto space-y-3 relative z-10">
            <span class="text-xs font-bold text-gold-400 uppercase tracking-widest bg-gold-500/10 px-3.5 py-1 rounded-full border border-gold-500/20">Album Foto Dokumentasi</span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Galeri Kegiatan Madrasah</h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                Kumpulan ragam aktivitas pembelajaran, pembiasaan ibadah, ekstrakurikuler, serta momen prestasi peserta didik.
            </p>
            <!-- Breadcrumb -->
                <div class="flex items-center justify-center gap-2 text-xs text-slate-400 pt-2">
                    <a href="/" class="text-gold-300 transition">Beranda</a>
                    <span>/</span>
                    <span class="text-gold-400 font-semibold">Galeri</span>
                </div>
        </div>
    </section>

    <!-- GALLERY CATEGORY TABS & FILTERABLE GRID -->
    <section class="py-16 bg-white" x-data="{ activeCategory: 'semua', selectedImg: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- 🏷️ TAB KATEGORI GALERI -->
            <div class="flex flex-wrap justify-center gap-2 mb-12">
                <!-- Tab 'Semua Foto' -->
                <button @click="activeCategory = 'semua'"
                        :class="activeCategory === 'semua' ? 'bg-brand-700 text-white font-bold shadow-md shadow-brand-700/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                        class="px-5 py-2.5 rounded-xl text-xs sm:text-sm transition duration-200">
                    Semua Foto
                </button>

                <!-- Tab Kategori Dinamis dari Database -->
                @foreach($kategoriGaleris as $kategori)
                    <button @click="activeCategory = '{{ $kategori->slug }}'"
                            :class="activeCategory === '{{ $kategori->slug }}' ? 'bg-brand-700 text-white font-bold shadow-md shadow-brand-700/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                            class="px-5 py-2.5 rounded-xl text-xs sm:text-sm transition duration-200">
                        {{ $kategori->nama }}
                    </button>
                @endforeach
            </div>

            <!-- 📷 GRID FOTO DENGAN FILTRASI INSTAN -->
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($galeris as $galeri)
                    @php
                        // Ambil array slug kategori pivot untuk pengecekan filter Alpine.js
                        $catSlugs = $galeri->kategoris->pluck('slug')->toArray();
                        $catSlugsJson = json_encode($catSlugs);
                    @endphp

                    <div x-show="activeCategory === 'semua' || {{ $catSlugsJson }}.includes(activeCategory)"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-90"
                         x-transition:enter-end="opacity-100 scale-100"
                         @click="selectedImg = { title: '{{ e($galeri->judul) }}', src: '{{ Storage::url($galeri->foto) }}', date: '{{ $galeri->created_at->format('d M Y') }}' }"
                         class="group relative overflow-hidden rounded-2xl bg-slate-900 cursor-pointer shadow-sm hover:shadow-xl transition duration-300 h-64">

                        <img src="{{ Storage::url($galeri->foto) }}" alt="{{ $galeri->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500 opacity-90">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 group-hover:opacity-100 transition flex flex-col justify-end p-4">
                            <div class="flex flex-wrap gap-1 mb-1">
                                @if($galeri->kategoris->isNotEmpty())
                                        @php
                                            $katNama = $galeri->kategoris->first()->nama;
                                            $badgeColorClass = getCategoryBadgeColor($katNama);
                                        @endphp

                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full border shadow-sm {{ $badgeColorClass }}">
                                            {{ $katNama }}
                                        </span>
                                @endif

                            </div>
                            <h3 class="text-sm font-bold text-white leading-snug">{{ $galeri->judul }}</h3>
                            <p class="text-[11px] text-gold-300 mt-0.5"><i class="fa-regular fa-calendar mr-1"></i> {{ $galeri->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-500">
                        <p class="text-sm">Belum ada foto di galeri.</p>
                    </div>
                @endforelse
            </div>

        </div>

        <!-- 🔍 LIGHTBOX MODAL POPUP -->
        <div x-show="selectedImg"
             x-transition
             class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md"
             style="display: none;">
            <div @click.away="selectedImg = null" class="bg-white rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl relative">
                <button @click="selectedImg = null" class="absolute top-4 right-4 z-10 w-9 h-9 rounded-full bg-black/50 text-white flex items-center justify-center hover:bg-black transition">
                    <i class="fa-solid fa-xmark text-base"></i>
                </button>
                <div class="h-[380px] sm:h-[450px] bg-slate-900">
                    <img :src="selectedImg?.src" class="w-full h-full object-cover">
                </div>
                <div class="p-6 bg-white space-y-1">
                    <span class="text-xs font-bold text-gold-600" x-text="selectedImg?.date"></span>
                    <h3 class="text-lg font-bold text-slate-900" x-text="selectedImg?.title"></h3>
                </div>
            </div>
        </div>
    </section>

@endsection
