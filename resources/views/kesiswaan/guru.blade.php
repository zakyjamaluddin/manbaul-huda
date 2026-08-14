@extends('layouts.app')

@section('title', 'Tenaga Pendidik & Guru - MI Manba\'ul Huda Sekaran')

@section('content')


    <!-- HERO BANNER -->
    <section class="bg-gradient-to-br from-slate-900 via-brand-900 to-slate-900 text-white py-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto space-y-3">
                <span class="text-xs font-bold text-gold-400 uppercase tracking-widest bg-gold-500/10 px-3 py-1 rounded-full border border-gold-500/20">Pendidik Berkompeten</span>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Tenaga Pendidik & Guru</h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Dewan guru & staf profesional yang siap membimbing putra-putri Anda.
                </p>
                <!-- Breadcrumb -->
                <div class="flex items-center justify-center gap-2 text-xs text-slate-400 pt-2">
                    <a href="/" class="text-gold-300 transition">Beranda</a>
                    <span>/</span>
                    <span class="text-gold-400 font-semibold">Tenaga Pendidik</span>
                </div>
            </div>
        </div>
    </section>


    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($gurus as $guru)
                    <div class="bg-white rounded-3xl border border-slate-200/90 overflow-hidden shadow-soft hover:shadow-xl transition p-5 text-center space-y-3">
                        <div class="w-32 h-32 rounded-full overflow-hidden mx-auto bg-slate-100 border-2 border-gold-500/40 shadow">
                            @if(!empty($guru->foto))
                                <img src="{{ Storage::url($guru->foto) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-brand-900 text-gold-300 text-3xl font-bold">
                                    <i class="fa-solid fa-user-tie"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 text-base leading-snug">{{ $guru->nama }}</h3>
                            <span class="inline-block mt-1 px-3 py-0.5 rounded-full bg-brand-50 text-brand-700 text-xs font-semibold">{{ $guru->jabatan }}</span>
                        </div>
                        @if(!empty($guru->nomor_wa))
                            <div class="pt-2 border-t border-slate-100">
                                @php
                                    $cleanWaGuru = preg_replace('/[^0-9]/', '', $guru->nomor_wa);
                                    if (str_starts_with($cleanWaGuru, '0')) { $cleanWaGuru = '62' . substr($cleanWaGuru, 1); }
                                @endphp
                                <a href="https://api.whatsapp.com/send?phone={{ $cleanWaGuru }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-emerald-700">
                                    <i class="fa-brands fa-whatsapp text-sm"></i> Kontak Guru
                                </a>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-500">
                        <p class="text-sm">Data tenaga pendidik belum diisi.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection
