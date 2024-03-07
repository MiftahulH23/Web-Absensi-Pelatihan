<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absen_pesertas', function (Blueprint $table) {
                $table->id();
                $table->string('nama');
                $table->string('norek');
                $table->string('nik');
                $table->string('levelJabatan');
                $table->string('jabatan');
                $table->string('unitKantor');
                $table->string('foto');
                $table->string('ttd');
                    
        });
    }
  
};
