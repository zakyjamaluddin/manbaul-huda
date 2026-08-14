@extends('layouts.app')

@section('title', 'Prestasi Siswa - MI Manba\'ul Huda Sekaran')

@section('content')

    <section class="bg-gradient-to-br from-slate-900 via-brand-900 to-slate-900 text-white py-16 text-center">
        <span class="text-xs font-bold text-gold-400 uppercase tracking-widest bg-gold-500/10 px-3 py-1 rounded-full border border-gold-500/20">Kebanggaan Kita</span>
        <h1 class="text-3xl sm:text-5xl font-extrabold mt-2">Prestasi Siswa</h1>
        <p class="text-slate-300 text-sm mt-2">Daftar lengkap raihan kejuaraan akademik dan non-akademik siswa MI Manba'ul Huda.</p>
        <!-- Breadcrumb -->
                <div class="flex items-center justify-center gap-2 text-xs text-slate-400 pt-2 mt-4">
                    <a href="/" class="text-gold-300 transition">Beranda</a>
                    <span>/</span>
                    <span class="text-gold-400 font-semibold">Prestasi</span>
                </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($prestasis as $prestasi)
                    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-soft hover:shadow-xl transition duration-300">
                        <div class="relative h-48 bg-slate-100 overflow-hidden">
                            <img src="{{ Storage::url($prestasi->foto) }}" class="w-full h-full object-cover">
                            <div class="absolute top-3 left-3 bg-gold-500 text-slate-950 font-extrabold text-[11px] px-2.5 py-1 rounded-lg shadow">
                                {{ $prestasi->prestasi }}
                            </div>
                        </div>
                        <div class="p-5 space-y-2">
                            <span class="text-[11px] text-slate-400 font-semibold"><i class="fa-regular fa-calendar mr-1"></i> {{ $prestasi->created_at->format('d M Y') }}</span>
                            <h3 class="font-bold text-slate-900 text-base">{{ $prestasi->judul }}</h3>
                            <p class="text-xs text-slate-600 leading-relaxed">{{ $prestasi->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $prestasis->links() }}
            </div>
        </div>
    </section>

@endsection
