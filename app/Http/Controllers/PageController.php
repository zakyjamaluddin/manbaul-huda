<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HeroSection;
use App\Models\WhyUs;
use App\Models\Profil;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Blog;
use App\Models\KategoriBlog;
use App\Models\KategoriGaleri;
use App\Models\Pengumuman;
use App\Models\AgendaMadrasah;
use App\Models\TenagaPendidik;

class PageController extends Controller
{
    public function index()
    {
        return view('index', [
            'hero' => HeroSection::find(1) ?? HeroSection::first(),
            'whyUs' => WhyUs::all(),
            'profil' => Profil::find(1) ?? Profil::first(),
            'prestasis' => Prestasi::latest()->take(3)->get(),
            'galeris' => Galeri::latest()->take(8)->get(),
            'blogs' => Blog::latest()->take(4)->get(),
        ]);
    }

    public function gallery()
    {
        return view('gallery', [
            'kategoriGaleris' => KategoriGaleri::all(),
            'galeris' => Galeri::with('kategoris')->latest()->get(),
        ]);
    }
    

    public function pengumuman()
    {
        return view('pengumuman', [
            'pinnedPengumuman' => Pengumuman::with('kategoris')->where('is_disematkan', true)->first(),
            'pengumumans' => Pengumuman::with('kategoris')->where('is_disematkan', false)->latest()->get(),
        ]);
    }

    public function blog(Request $request)
    {
        return view('blog.index', [
            'featuredBlog' => Blog::with('kategoris')->where('is_disematkan', true)->first() ?? Blog::latest()->first(),
            'blogs' => Blog::with('kategoris')->latest()->paginate(6),
            'kategoriBlogs' => KategoriBlog::withCount('blogs')->get(),
        ]);
    }

    public function blogDetail($slug)
    {
        $blog = Blog::with('kategoris')->where('slug', $slug)->firstOrFail();
        $relatedBlogs = Blog::where('id', '!=', $blog->id)->latest()->take(3)->get();

        return view('blog.show', [
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs,
        ]);
    }

    // --- SUBMENU KESISWAAN ---
    public function kesiswaanPrestasi()
    {
        return view('kesiswaan.prestasi', [
            'prestasis' => Prestasi::latest()->paginate(9),
        ]);
    }

    public function kesiswaanAgenda()
    {
        return view('kesiswaan.agenda', [
            'agendas' => AgendaMadrasah::orderBy('tanggal_pelaksanaan', 'desc')->get(),
        ]);
    }

    public function kesiswaanGuru()
    {
        return view('kesiswaan.guru', [
            'gurus' => TenagaPendidik::orderBy('urutan', 'asc')->get(),
        ]);
    }
}
