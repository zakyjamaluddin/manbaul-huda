@extends('layouts.app')

@section('title', 'Agenda Madrasah - MI Manba\'ul Huda Sekaran')

@section('content')

    <section class="bg-gradient-to-br from-slate-900 via-brand-900 to-slate-900 text-white py-16 text-center">
        <span class="text-xs font-bold text-gold-400 uppercase tracking-widest bg-gold-500/10 px-3 py-1 rounded-full border border-gold-500/20">Jadwal & Kegiatan</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-2">Agenda Madrasah</h1>
        <p class="text-slate-300 text-sm mt-2">Jadwal kegiatan rutin keagamaan, ujian akademik, dan peringatan hari besar.</p>
        <!-- Breadcrumb -->
        <div class="flex items-center justify-center gap-2 text-xs text-slate-400 pt-2 mt-4">
            <a href="/" class="text-gold-300 transition">Beranda</a>
            <span>/</span>
            <span class="text-gold-400 font-semibold">Agenda</span>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
            @forelse($agendas as $agenda)
                <div class="p-6 rounded-2xl bg-white border border-slate-200/90 shadow-soft flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:border-brand-500 transition">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-700 flex flex-col items-center justify-center shrink-0 border border-brand-200">
                            <span class="text-xs uppercase font-bold text-gold-600">{{ $agenda->tanggal_pelaksanaan->format('M') }}</span>
                            <span class="text-lg font-extrabold leading-none">{{ $agenda->tanggal_pelaksanaan->format('d') }}</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2.5 py-0.5 rounded-full bg-gold-100 text-gold-700 font-bold text-[10px]">{{ $agenda->kategori }}</span>
                                <span class="text-xs text-slate-400"><i class="fa-solid fa-location-dot mr-1"></i> {{ $agenda->lokasi }}</span>
                            </div>
                            <h3 class="text-base font-bold text-slate-900">{{ $agenda->judul }}</h3>
                            @if(!empty($agenda->deskripsi))
                                <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $agenda->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 text-slate-500">
                    <p class="text-sm">Belum ada agenda mendatang.</p>
                </div>
            @endforelse
        </div>
    </section>

@endsection
