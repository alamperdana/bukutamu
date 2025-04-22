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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_layanan_id')->constrained('ref_lokasi_layanan')->onDelete('cascade');
            $table->string('asal');
            $table->string('jabatan');
            $table->string('nama');
            $table->string('no_telp');
            $table->foreignId('layanan_id')->constrained('ref_layanan')->onDelete('cascade');
            $table->string('lainnya')->nullable();
            $table->string('photo_path');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->date('tanggal');
            $table->time('jam_pelayanan');
            $table->foreignId('status_id')->constrained('ref_status')->onDelete('cascade');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
