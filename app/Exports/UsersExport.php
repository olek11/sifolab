<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all(); // Ambil semua data pengguna
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'Email', 'Type User']; // Definisikan header
    }
}
