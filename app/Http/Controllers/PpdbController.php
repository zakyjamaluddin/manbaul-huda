<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranSiswaBaru;

class PpdbController extends Controller
{
    public function index()
    {
        return view('ppdb');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:20',
            'asal_sekolah' => 'required|string|max:255',
            'nama_orangtua' => 'required|string|max:255',
            'nomor_whatsapp_orangtua' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
        ]);

        PendaftaranSiswaBaru::create($validated);

        // Kirim data ter-input ke session 'success_pendaftaran'
        return redirect()->back()->with('success_pendaftaran', $validated);
    }
}
