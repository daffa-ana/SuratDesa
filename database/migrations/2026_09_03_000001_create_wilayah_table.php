<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rw', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rw', 3);
            $table->string('nama_ketua', 100);
            $table->text('alamat');
            $table->string('telepon', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('rt', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rt', 3);
            $table->foreignId('rw_id')->constrained('rw')->cascadeOnDelete();
            $table->string('nama_ketua', 100);
            $table->text('alamat');
            $table->string('telepon', 20)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rt');
        Schema::dropIfExists('rw');
    }
};