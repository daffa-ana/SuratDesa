<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat', 50)->unique();
            $table->string('jenis_surat', 40);
            $table->foreignId('penduduk_id')->constrained('penduduk')->cascadeOnDelete();
            $table->foreignId('rt_id')->nullable()->constrained('rt')->nullOnDelete();
            $table->foreignId('rw_id')->nullable()->constrained('rw')->nullOnDelete();
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 30)->default('pending');
            $table->timestamp('tanggal_pengajuan')->useCurrent();
            $table->timestamp('tanggal_rt')->nullable();
            $table->timestamp('tanggal_rw')->nullable();
            $table->timestamp('tanggal_final')->nullable();
            $table->text('keperluan')->nullable();
            $table->text('catatan_rt')->nullable();
            $table->text('catatan_rw')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->json('data_tambahan')->nullable();
            $table->string('file_pdf')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('surat_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('action', 50);
            $table->string('old_status', 30)->nullable();
            $table->string('new_status', 30)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_logs');
        Schema::dropIfExists('surat');
    }
};