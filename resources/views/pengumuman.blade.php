@extends('layouts.app')

@section('title', 'Pengumuman Resmi - MI Manba\'ul Huda Sekaran')

@section('content')

    <section class="bg-gradient-to-br from-slate-900 via-brand-900 to-slate-900 text-white py-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <div class="inline-flex items-center gap-2 bg-amber-500/20 text-amber-300 border border-amber-500/30 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-widest">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                    </span>
                    <span>Informasi & Pengumuman Resmi</span>
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Pengumuman Terbaru</h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Dapatkan kabar dan surat edaran resmi terbaru seputar agenda madrasah, akademik, dan pendaftaran siswa baru.
                </p>
                <!-- Breadcrumb -->
                <div class="flex items-center justify-center gap-2 text-xs text-slate-400 pt-2">
                    <a href="/" class="text-gold-300 transition">Beranda</a>
                    <span>/</span>
                    <span class="text-gold-400 font-semibold">Pengumuman</span>
                </div>
            </div>
        </div>
    </section>

    <!-- LIST PENGUMUMAN -->
    <section class="py-16 bg-white" x-data="{ modalOpen: false, modalItem: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- 📌 1. PENGUMUMAN DISEMATKAN (BACKGROUND HIJAU EMERALD EKSLUSIF) -->
            <!-- PENGUMUMAN DISEMATKAN -->
@if($pinnedPengumuman)
    <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-r from-brand-900 via-brand-800 to-slate-900 text-white shadow-2xl border-l-8 border-gold-500 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="space-y-3 max-w-3xl">
            <div class="flex items-center gap-3 text-xs">
                <span class="px-3 py-1 rounded-full bg-gold-500 text-slate-950 font-extrabold flex items-center gap-1.5 shadow">
                    <i class="fa-solid fa-thumbtack text-xs"></i> DISEMATKAN (UTAMA)
                </span>

                {{-- LOOP KATEGORI PIVOT --}}
                @foreach($pinnedPengumuman->kategoris as $kat)
                    <span class="px-2.5 py-0.5 rounded-full bg-white/10 text-gold-300 font-semibold border border-white/10">{{ $kat->nama }}</span>
                @endforeach

                <span class="text-slate-300 font-medium"><i class="fa-regular fa-calendar mr-1"></i> {{ $pinnedPengumuman->created_at->format('d M Y') }}</span>
            </div>

            <h3 class="text-xl sm:text-2xl font-extrabold text-white">{{ $pinnedPengumuman->judul }}</h3>
            <p class="text-xs sm:text-sm text-slate-200 line-clamp-2">{!! strip_tags($pinnedPengumuman->konten) !!}</p>
        </div>
    </div>
@endif

<!-- PENGUMUMAN REGULER -->
@foreach($pengumumans as $item)
    <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-soft flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="space-y-2 max-w-3xl">
            <div class="flex items-center gap-3 text-xs">
                <span class="px-3 py-1 rounded-full bg-brand-50 text-brand-700 font-bold">Pengumuman</span>

                {{-- LOOP KATEGORI PIVOT --}}
                @foreach($item->kategoris as $kat)
                    <span class="px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 font-semibold">{{ $kat->nama }}</span>
                @endforeach

                <span class="text-slate-400 font-medium"><i class="fa-regular fa-calendar mr-1"></i> {{ $item->created_at->format('d M Y') }}</span>
            </div>

            <h3 class="text-lg font-bold text-slate-900">{{ $item->judul }}</h3>
            <p class="text-xs text-slate-600 line-clamp-2">{!! strip_tags($item->konten) !!}</p>
        </div>
    </div>
@endforeach

        </div>

        <!-- MODAL READER POPUP -->
        <div x-show="modalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" style="display: none;">
            <div @click.away="modalOpen = false" class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative space-y-4 max-h-[85vh] overflow-y-auto">
                <button @click="modalOpen = false" class="absolute top-4 right-4 w-9 h-9 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>

                <div class="border-b border-slate-100 pb-3">
                    <span class="text-xs font-bold text-gold-600" x-text="modalItem?.date"></span>
                    <h3 class="text-xl font-bold text-slate-900 mt-1" x-text="modalItem?.title"></h3>
                </div>

                <div class="text-xs sm:text-sm text-slate-700 leading-relaxed prose max-w-none space-y-3" x-html="modalItem?.desc"></div>
            </div>
        </div>
    </section>

@endsection
