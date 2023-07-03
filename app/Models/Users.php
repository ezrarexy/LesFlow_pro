<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jk',
        'dob',
        'nik',
        'alamat',
        'telp',
        'email',
        'gaji_pokok',
        'photo_ktp'
    ];
}
