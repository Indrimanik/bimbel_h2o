<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('foto')->nullable(); // nama file gambar
            $table->string('mapel')->nullable(); // mata pelajaran utama
            $table->string('pendidikan')->nullable(); // S1, S2, dst.
            $table->string('universitas')->nullable(); // nama universitas
            $table->integer('pengalaman')->default(0); // tahun pengalaman
            $table->text('bio')->nullable(); // deskripsi singkat
            $table->decimal('rating', 3, 1)->default(5.0); // rating 0.0 - 5.0
            $table->integer('total_ulasan')->default(0);
            $table->integer('total_siswa')->default(0);
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->json('sertifikasi')->nullable(); // list sertifikat
            $table->json('jadwal')->nullable(); // hari & jam tersedia
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajars');
    }
};
