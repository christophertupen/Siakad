<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Forget cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create permission 'akademik'
        $permAkademik = Permission::firstOrCreate([
            'name' => 'akademik',
            'guard_name' => 'web',
        ]);

        // 2. Create role 'akademik'
        $roleAkademik = Role::firstOrCreate(['name' => 'akademik']);
        $roleAkademik->givePermissionTo($permAkademik);

        // 3. Define akademik permissions based on access rights
        $akademikPermissions = [
            // Kelas: CRUD
            'view_any_kelas', 'view_kelas', 'create_kelas', 'update_kelas', 'delete_kelas',
            // Mata Pelajaran: CRUD
            'view_any_mata::pelajaran', 'view_mata::pelajaran', 'create_mata::pelajaran', 'update_mata::pelajaran', 'delete_mata::pelajaran',
            // Jadwal Pelajaran: CRUD
            'view_any_jadwal::pelajaran', 'view_jadwal::pelajaran', 'create_jadwal::pelajaran', 'update_jadwal::pelajaran', 'delete_jadwal::pelajaran',
            // Materi: Read Only
            'view_any_materi', 'view_materi',
            // Tugas: Read Only
            'view_any_tugas', 'view_tugas',
            // Nilai: Read Only
            'view_any_nilai', 'view_nilai',
            // Absensi: Read Only
            'view_any_absensi', 'view_absensi',
            // Rapor: Read Only
            'view_any_rapor', 'view_rapor',
            // Pengumuman (Berita): CRUD
            'view_any_berita', 'view_berita', 'create_berita', 'update_berita', 'delete_berita',
        ];

        foreach ($akademikPermissions as $permName) {
            $permission = Permission::where('name', $permName)->first();
            if ($permission) {
                $roleAkademik->givePermissionTo($permission);
            }
        }

        // 4. Create user dummy akademik
        $user = User::firstOrCreate(
            ['email' => 'akademik@siakad.test'],
            [
                'name' => 'Staff Akademik',
                'password' => Hash::make('password'),
                'role' => 'akademik',
                'status' => true,
            ]
        );

        $user->assignRole('akademik');
    }
}
