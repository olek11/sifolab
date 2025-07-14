<?php

namespace App\Exports;

use App\Models\Bahan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BahanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Bahan::all(); // Ambil semua data alat
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Bahan',
            'Jumlah Bahan',
            'Satuan',
            'Keterangan'
            // Tambahkan kolom lain sesuai kebutuhan"
        ]; // Sesuaikan dengan kolom tabel
    }
}
