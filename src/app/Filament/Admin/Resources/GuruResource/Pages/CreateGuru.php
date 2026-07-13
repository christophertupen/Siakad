<?php

namespace App\Filament\Admin\Resources\GuruResource\Pages;

use App\Filament\Admin\Resources\GuruResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateGuru extends CreateRecord
{
    protected static string $resource = GuruResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        return DB::transaction(function () use ($data) {

            // Membuat akun login
            $user = User::create([
                'name'             => $data['nama'],
                'email'            => $data['email'],
                'password'         => Hash::make($data['password']),
                'role'             => 'guru',
                'nip'              => $data['nip'],
                'status'           => $data['confirmed'] ?? true,
                'email_verified_at'=> now(),
            ]);

            // Hapus field yang bukan milik tabel gurus
            unset(
                $data['email'],
                $data['password'],
                $data['password_confirmation']
            );

            // Isi user_id secara otomatis
            $data['user_id'] = $user->id;

            // Simpan data guru
            return static::getModel()::create($data);
        });
    }
}