<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\OrangTua;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
        $adminUser->assignRole('super_admin');

        // 2. Guru
        $guruUser = User::firstOrCreate(
            ['email' => 'guru@admin.com'],
            [
                'name' => 'Guru Account',
                'password' => Hash::make('password'),
                'role' => 'guru',
            ]
        );
        $guruUser->assignRole('guru');
        $guruUser->assignRole('panel_user_guru');

        Guru::firstOrCreate(
            ['user_id' => $guruUser->id],
            [
                'nip' => '198203112009121003',
                'nama' => 'Guru Account',
                'gelar' => 'S.Pd',
                'pendidikan_terakhir' => 'S1',
                'bidang_keahlian' => 'Matematika',
                'confirmed' => true,
            ]
        );

        // 3. Siswa
        $siswaUser = User::firstOrCreate(
            ['email' => 'siswa@admin.com'],
            [
                'name' => 'Siswa Account',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]
        );
        $siswaUser->assignRole('siswa');
        $siswaUser->assignRole('panel_user_siswa');

        $siswa = Siswa::firstOrCreate(
            ['user_id' => $siswaUser->id],
            [
                'nis' => '12345',
                'nisn' => '0098765432',
                'nama' => 'Siswa Account',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2010-05-15',
                'agama' => 'Islam',
                'alamat' => 'Jl. Merdeka No. 10',
                'nomor_hp' => '081234567890',
                'tanggal_masuk' => '2024-07-15',
                'status' => true,
            ]
        );

        // 4. Orang Tua
        // Update password for any existing users with 'orang_tua' role to 'password'
        User::where('role', 'orang_tua')->update([
            'password' => Hash::make('password'),
        ]);

        $orangTuaUser = User::where('email', 'orangtua@admin.com')->first();
        if ($orangTuaUser) {
            $orangTuaUser->update([
                'password' => Hash::make('password'),
            ]);
        } else {
            $orangTuaUser = User::create([
                'email' => 'orangtua@admin.com',
                'name' => 'Orang Tua Account',
                'password' => Hash::make('password'),
                'role' => 'orang_tua',
            ]);
        }
        $orangTuaUser->assignRole('orang_tua');
        $orangTuaUser->assignRole('panel_user_orangtua');

        OrangTua::firstOrCreate(
            ['user_id' => $orangTuaUser->id],
            [
                'siswa_id' => $siswa->id,
                'nik' => '3171123456789001',
                'nama' => 'Orang Tua Account',
                'hubungan' => 'Ayah',
                'pekerjaan' => 'Wiraswasta',
                'nomor_telepon' => '089876543210',
                'alamat' => 'Jl. Merdeka No. 10',
                'status' => true,
            ]
        );
    }
}
