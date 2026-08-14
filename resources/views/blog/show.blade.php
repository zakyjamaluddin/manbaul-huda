@extends('layouts.app')

{{-- META SEO & OPEN GRAPH KHUSUS DETAIL BLOG --}}
@section('title', $blog->judul . ' - ' . ($globalProfil->nama_madrasah ?? "MI Manba'ul Huda"))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($blog->konten), 160))

@section('og_type', 'article')
@section('og_title', $blog->judul)
@section('og_description', \Illuminate\Support\Str::limit(strip_tags($blog->konten), 160))
@section('og_image', Storage::url($blog->thumbnail))

@section('content')

    <!-- ARTICLE HEADER (CUKUP TANGGAL PUBLISH SAJA) -->
    <section class="py-12 bg-white border-b border-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">

            <div class="flex items-center gap-2 text-xs text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-brand-700">Beranda</a>
                <span>/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-brand-700">Blog</a>
                <span>/</span>
                <span class="text-brand-700 font-semibold truncate">{{ $blog->judul }}</span>
            </div>

            @if($blog->kategoris->isNotEmpty())
                <div class="flex flex-wrap gap-2">
                    @foreach($blog->kategoris as $kat)
                        <span class="px-3 py-1 rounded-full bg-brand-50 text-brand-700 text-xs font-bold border border-brand-200">{{ $kat->nama }}</span>
                    @endforeach
                </div>
            @endif

            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                {{ $blog->judul }}
            </h1>

            <!-- CUKUP TANGGAL PUBLISH SAJA (TANPA PENULIS) -->
            <div class="flex items-center gap-2 text-xs text-slate-500 pt-2 border-t border-slate-100">
                <i class="fa-regular fa-calendar-check text-gold-600"></i>
                <span>Dipublikasikan: <strong class="text-slate-800">{{ $blog->created_at->format('d M Y') }}</strong></span>
            </div>

        </div>
    </section>

    <!-- ARTICLE BODY -->
    <main class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="rounded-3xl overflow-hidden shadow-xl bg-slate-900">
                <img src="{{ Storage::url($blog->thumbnail) }}" alt="{{ $blog->judul }}" class="w-full h-[320px] sm:h-[450px] object-cover">
            </div>

            <article class="article-content max-w-none">
                {!! $blog->konten !!}
            </article>

            <div class="pt-6 border-t border-slate-200 flex justify-between items-center text-xs">
                <span class="font-bold text-slate-600">Bagikan Artikel Ini:</span>
                <div class="flex items-center gap-2">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->judul . ' ' . request()->fullUrl()) }}" target="_blank" class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
            </div>

        </div>
    </main>

    <!-- ARTIKEL TERKAIT -->
    <section class="py-16 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-extrabold text-slate-900 mb-8">Artikel Terkait Lainnya</h2>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedBlogs as $rel)
                    <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-soft">
                        <div class="h-44 bg-slate-100 overflow-hidden relative">
                            <img src="{{ Storage::url($rel->thumbnail) }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-5 space-y-2">
                            <span class="text-[11px] text-slate-400 font-medium"><i class="fa-regular fa-clock mr-1"></i> {{ $rel->created_at->format('d M Y') }}</span>
                            <h3 class="font-bold text-slate-900 text-sm line-clamp-2">{{ $rel->judul }}</h3>
                            <a href="{{ route('blog.show', $rel->slug) }}" class="inline-block text-xs font-bold text-brand-700 pt-1">Baca Selengkapnya &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
