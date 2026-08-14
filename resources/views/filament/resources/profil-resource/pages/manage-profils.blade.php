<x-filament-panels::page>
    @if (\App\Models\Profil::first())
        {{-- Tampilkan Infolist Keren --}}
        {{ $this->infolist }}
    @else
        {{-- Tampilan jika data belum pernah diisi --}}
        <div class="p-12 text-center text-slate-500 bg-white rounded-3xl border border-slate-200 shadow-sm space-y-3">
            <div class="w-16 h-16 rounded-full bg-brand-50 text-brand-700 mx-auto flex items-center justify-center text-2xl">
                <i class="fa-solid fa-building-columns"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum Ada Data Profil Madrasah</h3>
            <p class="text-xs text-slate-500">Silakan klik tombol <strong>Input Profil Utama</strong> di kanan atas untuk mengisi data pertama kali.</p>
        </div>
    @endif
</x-filament-panels::page>