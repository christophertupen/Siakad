<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'Nilai' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'Absensi' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'JadwalPelajaran' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'Pembayaran' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'Siswa' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'Guru' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'OrangTua' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'Kelas' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'MataPelajaran' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'TahunAjaran' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'JenisPembayaran' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'User' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'Rapor' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'Materi' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'Tugas' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'PengumpulanTugas' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
            'BankSoal' => ['view_any', 'view', 'create', 'update', 'delete', 'delete_any'],
        ];

        foreach ($permissions as $model => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$action}_{$model}",
                    'guard_name' => 'web',
                ]);
            }
        }

        $guruRole = Role::firstOrCreate(['name' => 'guru']);
        $siswaRole = Role::firstOrCreate(['name' => 'siswa']);
        $orangTuaRole = Role::firstOrCreate(['name' => 'orang_tua']);

        $guruPermissions = [
            'view_any_Nilai', 'view_Nilai', 'create_Nilai', 'update_Nilai',
            'view_any_Absensi', 'view_Absensi', 'create_Absensi', 'update_Absensi',
            'view_any_JadwalPelajaran', 'view_JadwalPelajaran',
            'view_any_Materi', 'view_Materi', 'create_Materi', 'update_Materi',
            'view_any_Tugas', 'view_Tugas', 'create_Tugas', 'update_Tugas',
            'view_any_PengumpulanTugas', 'view_PengumpulanTugas',
            'view_any_BankSoal', 'view_BankSoal', 'create_BankSoal', 'update_BankSoal',
            'view_any_Siswa', 'view_Siswa',
            'view_any_Kelas', 'view_Kelas',
            'view_any_MataPelajaran', 'view_MataPelajaran',
            'view_any_TahunAjaran', 'view_TahunAjaran',
        ];

        $siswaPermissions = [
            'view_any_Nilai', 'view_Nilai',
            'view_any_Absensi', 'view_Absensi',
            'view_any_JadwalPelajaran', 'view_JadwalPelajaran',
            'view_any_Materi', 'view_Materi',
            'view_any_Tugas', 'view_Tugas',
            'create_PengumpulanTugas', 'view_any_PengumpulanTugas', 'view_PengumpulanTugas',
            'view_any_BankSoal', 'view_BankSoal',
            'view_any_Pembayaran', 'view_Pembayaran',
            'view_any_Rapor', 'view_Rapor',
        ];

        $orangTuaPermissions = [
            'view_any_Nilai', 'view_Nilai',
            'view_any_Absensi', 'view_Absensi',
            'view_any_JadwalPelajaran', 'view_JadwalPelajaran',
            'view_any_Pembayaran', 'view_Pembayaran', 'create_Pembayaran',
            'view_any_Rapor', 'view_Rapor',
            'view_any_Siswa', 'view_Siswa',
        ];

        foreach ($guruPermissions as $perm) {
            $permission = Permission::where('name', $perm)->first();
            if ($permission) {
                $guruRole->givePermissionTo($permission);
            }
        }

        foreach ($siswaPermissions as $perm) {
            $permission = Permission::where('name', $perm)->first();
            if ($permission) {
                $siswaRole->givePermissionTo($permission);
            }
        }

        foreach ($orangTuaPermissions as $perm) {
            $permission = Permission::where('name', $perm)->first();
            if ($permission) {
                $orangTuaRole->givePermissionTo($permission);
            }
        }

        $panelUserGuru = Role::firstOrCreate(['name' => 'panel_user_guru']);
        $panelUserSiswa = Role::firstOrCreate(['name' => 'panel_user_siswa']);
        $panelUserOrangTua = Role::firstOrCreate(['name' => 'panel_user_orangtua']);

        foreach ($guruPermissions as $perm) {
            $permission = Permission::where('name', $perm)->first();
            if ($permission) {
                $panelUserGuru->givePermissionTo($permission);
            }
        }

        foreach ($siswaPermissions as $perm) {
            $permission = Permission::where('name', $perm)->first();
            if ($permission) {
                $panelUserSiswa->givePermissionTo($permission);
            }
        }

        foreach ($orangTuaPermissions as $perm) {
            $permission = Permission::where('name', $perm)->first();
            if ($permission) {
                $panelUserOrangTua->givePermissionTo($permission);
            }
        }
    }
}