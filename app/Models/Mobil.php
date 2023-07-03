<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tahun',
        'warna',
        'nomor_bpkb',
        'an_bpkb',
        'ktp_an_bpkb',
        'nomor_rangka',
        'nomor_mesin',
        'nomor_polisi',
        'jt_pkb',
        'jt_stnk',
        'status',
        'harga_beli',
        'harga_bottom',
        'harga_jual',
        'photo_bpkb',
        'photo_pkb',
        'photo_stnk'
    ];
}
