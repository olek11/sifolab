<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahans';
    protected $fillable = [
        'name',
        'jumlah_bahan',
        'satuan',
        'deskripsi'
    ];
}
