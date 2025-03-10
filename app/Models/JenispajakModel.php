<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenispajakModel extends Model
{
    use HasFactory;
    protected $table = "tb_jenis_pajak";
    protected $primaryKey = "id";
    protected $fillable = [
        'jenis_pajak',
    ];
}
