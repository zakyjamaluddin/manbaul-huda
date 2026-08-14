@extends('layouts.app')

@section('title', 'Pendaftaran Siswa Baru (PPDB) - MI Manba\'ul Huda')

@section('content')

    <section class="bg-gradient-to-br from-slate-900 via-brand-900 to-slate-900 text-white py-16 text-center">
        <h1 class="text-3xl sm:text-5xl font-extrabold">Pendaftaran Murid Baru</h1>
        <p class="text-slate-300 text-sm mt-2">Formulir Resmi Penerimaan Peserta Didik Baru (PPDB) T.A. 2025/2026</p>
    </section>

    <section class="py-16 bg-slate-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- 🟢 BOX NOTIFIKASI BERHASIL + CALL TO ACTION WHATSAPP KUSTOM -->
            @if(session('success_pendaftaran'))
                @php
                    $data = session('success_pendaftaran');
                    $namaSiswa = $data['nama_siswa'] ?? '';
                    $asalSekolah = $data['asal_sekolah'] ?? '';
                    $namaOrangtua = $data['nama_orangtua'] ?? '';

                    // Nomor WhatsApp Panitia PPDB Madrasah (Ganti dengan nomor panitia asli)

                    $nomorWaPanitia = $globalProfil->nomor_whatsapp ?? '081234567890';

                    // Naskah Pesan Otomatis Kustom
                    $pesanWa = "Assalamu'alaikum Warahmatullahi Wabarakatuh.\n\nYth. Panitia PPDB MI Manba'ul Huda Sekaran,\nSaya " . $namaOrangtua . " (Orang Tua / Wali dari " . $namaSiswa . " - Asal Sekolah: " . $asalSekolah . "), ingin mengonfirmasi pendaftaran online T.A. 2025/2026 yang baru saja kami kirimkan.\n\nMohon petunjuk untuk langkah verifikasi berkas selanjutnya. Terima kasih.";

                    $linkWa = "https://api.whatsapp.com/send?phone=" . $nomorWaPanitia . "&text=" . urlencode($pesanWa);
                @endphp

                <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-2xl border-2 border-brand-500 text-center space-y-5 mb-8">
                    <div class="w-16 h-16 rounded-full bg-brand-100 text-brand-700 mx-auto flex items-center justify-center text-3xl">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>

                    <div>
                        <h3 class="text-2xl font-extrabold text-slate-900">Pendaftaran Berhasil Dikirim!</h3>
                        <p class="text-sm text-slate-600 max-w-lg mx-auto leading-relaxed mt-1">
                            Terima kasih Bpk/Ibu. Data pendaftaran calon siswa atas nama <strong class="text-brand-700">{{ $namaSiswa }}</strong> telah tersimpan di sistem MI Manba'ul Huda.
                        </p>
                    </div>

                    <!-- Ringkasan Data -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-left text-xs space-y-2 max-w-md mx-auto">
                        <div class="flex justify-between border-b border-slate-200/60 pb-1.5">
                            <span class="text-slate-500">Nama Calon Siswa:</span>
                            <span class="font-bold text-slate-900">{{ $namaSiswa }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-200/60 pb-1.5">
                            <span class="text-slate-500">Asal Sekolah:</span>
                            <span class="font-bold text-slate-900">{{ $asalSekolah }}</span>
                        </div>
                        <div class="flex justify-between border-b border-slate-200/60 pb-1.5">
                            <span class="text-slate-500">Orang Tua / Wali:</span>
                            <span class="font-bold text-slate-900">{{ $namaOrangtua }}</span>
                        </div>
                    </div>

                    <!-- 🟢 TOMBOL CALL TO ACTION WHATSAPP -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
                        <a href="{{ $linkWa }}" target="_blank" class="w-full sm:w-auto px-7 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs sm:text-sm flex items-center justify-center gap-2.5 shadow-lg shadow-emerald-600/20 hover:scale-[1.02] transition">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <span>Konfirmasi Pendaftaran via WhatsApp Panitia</span>
                        </a>
                        <a href="{{ route('ppdb.index') }}" class="w-full sm:w-auto px-5 py-3.5 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs text-center transition">
                            Isi Formulir Lagi
                        </a>
                    </div>
                </div>
            @endif

            <!-- FORMULIR PENDAFTARAN -->
            <div class="bg-white p-6 sm:p-10 rounded-3xl shadow-xl border border-slate-200/80">
                <form action="{{ route('ppdb.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="space-y-4">
                        <h3 class="text-xs font-bold uppercase text-gold-600 bg-gold-100/60 px-3 py-1.5 rounded-lg w-max">Data Calon Siswa</h3>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Calon Siswa *</label>
                            <input type="text" name="nama_siswa" required placeholder="Contoh: Ahmad Fauzi Rahmatullah" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm">
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">NISN (jika ada)</label>
                                <input type="text" name="nisn" placeholder="10 digit NISN" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Asal Sekolah (TK / RA) *</label>
                                <input type="text" name="asal_sekolah" required placeholder="Contoh: RA Perwanida Sekaran" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-slate-100">
                        <h3 class="text-xs font-bold uppercase text-gold-600 bg-gold-100/60 px-3 py-1.5 rounded-lg w-max">Data Orang Tua & Kontak</h3>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Orang Tua / Wali *</label>
                                <input type="text" name="nama_orangtua" required placeholder="Nama Ayah / Ibu / Wali" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp *</label>
                                <input type="tel" name="nomor_whatsapp_orangtua" required placeholder="Contoh: 081234567890" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Lengkap *</label>
                            <textarea name="alamat_lengkap" required rows="3" placeholder="Nama Jalan, RT/RW, Desa, Kecamatan, Kabupaten" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 font-bold text-white bg-brand-700 hover:bg-brand-800 rounded-2xl shadow-lg flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane text-gold-300"></i> Kirim Pendaftaran Siswa Baru
                    </button>
                </form>
            </div>

        </div>
    </section>

@endsection
