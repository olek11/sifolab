<?php

namespace App\Models;

use App\Models\Alat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeminjamanAlat extends Model
{
    protected $table = 'peminjaman_alats';

    protected $fillable = [
        'nama_peminjam',
        'nim_nip_nidn',
        'nama_alat',
        'jurusan',
        'no_hp',
        'jumlah',
        'peminjaman',
        'pengembalian',
        'keterangan',
        'paraf_peminjam',
        'paraf_petugas',
    ];

    protected $casts = [
        'peminjaman' => 'date',
        'pengembalian' => 'date',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    /**
     * Relasi ke tabel alats
     */
    public function alat(): BelongsTo
    {
        return $this->belongsTo(Alat::class, 'nama_alat', 'id');
    }
}