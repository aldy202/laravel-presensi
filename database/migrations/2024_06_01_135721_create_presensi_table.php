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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id('id_absen');
            $table->foreignId('idpegawai')->constrained('users','idpegawai');
            $table->time('masuk');
            $table->date('tgl_absen');
            $table->string('kondisi', 50);
            $table->string('keterangan', 255);
            $table->foreignId('shift')->constrained('timeshift', 'id');
            $table->string('jobdesk', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
