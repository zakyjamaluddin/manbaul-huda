<?php

namespace App\Filament\Widgets;

use App\Models\PendaftaranSiswaBaru;
use App\Models\Prestasi;
use App\Models\Galeri;
use App\Models\Blog;
use App\Models\Pengumuman;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = -3;

    protected function getStats(): array
    {
        $totalPpdb = PendaftaranSiswaBaru::count();
        $pendingPpdb = PendaftaranSiswaBaru::where('status', 'pending')->count();
        $totalPrestasi = Prestasi::count();
        $totalGaleri = Galeri::count();
        $totalPost = Blog::count() + Pengumuman::count();

        return [
            Stat::make('Pendaftar PPDB', $totalPpdb . ' Siswa')
                ->description($pendingPpdb . ' Menunggu Verifikasi')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Total Prestasi', $totalPrestasi . ' Raihan')
                ->description('Prestasi Akademik & Non-Akademik')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('warning'),

            Stat::make('Galeri Foto', $totalGaleri . ' Dokumentasi')
                ->description('Foto Aktivitas Madrasah')
                ->descriptionIcon('heroicon-m-photo')
                ->color('info'),

            Stat::make('Artikel & Pengumuman', $totalPost . ' Postingan')
                ->description('Konten Terpublikasi')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
        ];
    }
}
