<?php

namespace App\Exports;

use App\Models\Alat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlatExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Alat::all(); // Ambil semua data alat
    }

    public function headings(): array
    {
        return [
            'Nama Alat',
            'No Inventaris',
            'Jumlah Alat',
            'Kondisi Alat',
            'Tahun Perolehan',
            'Merk/Type',
            'Penguasaan',
            'Gambar Alat',
            'Deskripsi',
            'NUP',
        ]; // Sesuaikan dengan kolom tabel
    }
}
