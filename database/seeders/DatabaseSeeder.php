<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Penduduk;
use App\Models\Surat;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);

        User::factory()->create(['name' => 'Ketua RT 001', 'email' => 'rt@example.com', 'role' => 'rt']);
        User::factory()->create(['name' => 'Ketua RW 001', 'email' => 'rw@example.com', 'role' => 'rw']);
        $pendudukUser = User::factory()->create(['name' => 'Budi Santoso', 'email' => 'penduduk@example.com', 'role' => 'penduduk']);

        $penduduk = Penduduk::create([
            'nik' => '3273010101010001',
            'nama' => 'Budi Santoso',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1990-01-01',
            'alamat' => 'Dusun Sukamaju RT 01 RW 01',
            'rt' => '001',
            'rw' => '001',
            'pekerjaan' => 'Wiraswasta',
            'user_id' => $pendudukUser->id,
        ]);

        Surat::create([
            'nomor_surat' => 'SKD/001/' . now()->format('m/Y'),
            'jenis_surat' => 'domisili',
            'penduduk_id' => $penduduk->id,
            'keperluan' => 'Keperluan administrasi warga',
        ]);
    }
}
