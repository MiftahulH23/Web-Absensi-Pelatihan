<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'norek',
        'nik',
        'levelJabatan',
        'jabatan',
        'unitKantor',
        'foto',
        'ttd',
    ];
}