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
        Schema::create('layanan_requests', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_layanan');
            $table->string('nama_lengkap');
            $table->string('nip_nik')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('pangkat_golongan')->nullable();
            $table->string('perangkat_daerah')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('file_lampiran')->nullable();
            $table->json('data_tambahan')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_requests');
    }
};
