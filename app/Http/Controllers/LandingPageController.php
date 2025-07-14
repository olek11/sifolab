<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{
    public function daftaralat()
    {
        $alats = Alat::orderBy('id')->get();
        // dd($alats); // Tampilkan data dan hentikan eksekusi untuk debugging
        return view('daftaralat', compact('alats'));
    }
    public function store(Request $request) // Tambahkan parameter $request
    {
        // Validasi data input dari form
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'no_inventaris' => 'required|string|max:255',
            'jumlah_alat' => 'required|integer|min:1',
            'kondisi_alat' => 'required|string|max:50|in:Baik,Rusak Ringan,Rusak Berat',
            'tahun_perolehan' => 'nullable|integer|min:1900|max:2099',
            'merk_type' => 'required|string|max:255',
            'penguasaan' => 'required|string|max:255',
            'gambar_alat' => 'nullable|image|mimes:jpg,jpeg,png|max:20480', // Perbaiki max size (20MB)
            'deskripsi' => 'nullable|string',
            'nup' => 'nullable|string|max:255',
            'is_published' => 'boolean', // Tambahkan validasi untuk is_published
        ], [
            'nama_alat.required' => 'Nama alat belum diisi.',
            'no_inventaris.required' => 'No. inventaris belum diisi.',
            'jumlah_alat.required' => 'Jumlah alat belum diisi.',
            'kondisi_alat.required' => 'Kondisi alat belum diisi.',
            'kondisi_alat.in' => 'Kondisi alat harus salah satu dari: Baik, Rusak Ringan, Rusak Berat.',
            'merk_type.required' => 'Merek/Type alat belum diisi.',
            'penguasaan.required' => 'Penguasaan alat belum diisi.',
            'gambar_alat.max' => 'Ukuran gambar tidak boleh lebih dari 20MB.',
            'gambar_alat.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
        ]);

        // Persiapan data untuk disimpan
        $data = $validated;
        $data['gambar_alat'] = $request->hasFile('gambar_alat') ? $request->file('gambar_alat')->store('alats', 'public') : null;
        $data['is_published'] = $request->has('is_published') ? true : false; // Handle checkbox

        // Simpan data ke database
        Alat::create($data);

        return redirect()->route('daftaralat')->with('success', 'Alat berhasil ditambahkan.');
    }
}
