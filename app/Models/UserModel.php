<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class UserModel extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'id',
        'id_opd',
        'fullname',
        'email',
        'password',
        'role',
        'gambar',
        'is_active',
        'nama_opd',
        'nip',
        'alamat',
        'no_hp',
        'hobi',
        'nama_pa_kpa',
        'nip_pa_kpa'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];
}
