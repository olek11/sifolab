<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alats';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_alat',
        'no_inventaris',
        'jumlah_alat',
        'kondisi_alat',
        'gambar_alat',
        'tahun_perolehan',
        'merk_type',
        'penguasaan',
        'keterangan'
    ];
    protected $casts = [
        'tahun_perolehan' => 'integer'
    ];
}
