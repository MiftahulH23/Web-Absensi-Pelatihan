<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Narasumber extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nik',
        'jabatan',
        'unitKantor',
        'jamMengajar',
        'materi',
        'foto',
        'ttd',
        'id_acara',

    ];
    protected $hidden = [
        'id_acara',
        'updated_at',
    ];
}
