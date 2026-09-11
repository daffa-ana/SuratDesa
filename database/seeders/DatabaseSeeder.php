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
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'rt@example.com'],
            ['name' => 'Ketua RT 001', 'password' => bcrypt('password'), 'role' => 'rt', 'email_verified_at' => now()]
        );

        User::updateOrCreate(
            ['email' => 'rw@example.com'],
            ['name' => 'Ketua RW 001', 'password' => bcrypt('password'), 'role' => 'rw', 'email_verified_at' => now()]
        );

        $pendudukUser = User::updateOrCreate(
            ['email' => 'penduduk@example.com'],
            ['name' => 'Budi Santoso', 'password' => bcrypt('password'), 'role' => 'penduduk', 'email_verified_at' => now()]
        );

        $penduduk = Penduduk::firstOrCreate(
            ['nik' => '3273010101010001'],
            [
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1990-01-01',
                'alamat' => 'Dusun Sukamaju RT 01 RW 01',
                'rt' => '001',
                'rw' => '001',
                'pekerjaan' => 'Wiraswasta',
                'user_id' => $pendudukUser->id,
            ]
        );

        Surat::firstOrCreate(
            ['nomor_surat' => 'SKD/001/' . now()->format('m/Y')],
            [
                'jenis_surat' => 'domisili',
                'penduduk_id' => $penduduk->id,
                'keperluan' => 'Keperluan administrasi warga',
            ]
        );
    }
}
