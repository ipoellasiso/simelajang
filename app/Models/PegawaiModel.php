<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class PegawaiModel extends Model
{
    protected $table = 'tbl_pegawai';

    protected $fillable = [
        'id_pegawai',
        'id_opd',
        'nip',
        'nama',
        'jenkel',
        'tgl_lahir',
        'email',
        'password',
        'role',
        'gambar',
        'alamat',
        'nama_opd',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
