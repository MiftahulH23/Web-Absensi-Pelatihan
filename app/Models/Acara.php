<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    protected $fillable = [
        'judul',
        'tempat',
        'tanggal',
        'absen',
        'jam',
    ];

    // Nonaktifkan timestamps
    public $timestamps = false;
}