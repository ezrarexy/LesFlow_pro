<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemakai',
        'alamat',
        'telp',
        'harga_jadi',
        'uang_spk',
        'DP',
        'cicilan',
        'tenor',
        'status'
    ];
}
