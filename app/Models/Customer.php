<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jk',
        'nik',
        'dob',
        'alamat',
        'telp',
        'photo_ktp',
        'instagram',
        'facebook'
    ];
}
