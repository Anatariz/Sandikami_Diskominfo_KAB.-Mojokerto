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
        Schema::create('layanan_katalogs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_layanan')->unique(); // e.g. email, tte
            $table->string('nama_layanan');
            $table->text('deskripsi');
            $table->string('ikon')->default('ri-file-list-3-line');
            $table->json('form_schema'); // Array of objects
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_katalogs');
    }
};
