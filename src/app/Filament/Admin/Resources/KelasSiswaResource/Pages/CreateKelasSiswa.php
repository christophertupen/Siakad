<?php

namespace App\Filament\Admin\Resources\KelasSiswaResource\Pages;

use App\Filament\Admin\Resources\KelasSiswaResource;
use App\Models\KelasSiswa;
use App\Models\OrangTua;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateKelasSiswa extends CreateRecord
{
    protected static string $resource = KelasSiswaResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        return DB::transaction(function () use ($data): KelasSiswa {
            $orangTuaData = Arr::only($data, [
                'nik',
                'nama_orang_tua',
                'hubungan',
                'pekerjaan',
                'nomor_telepon',
                'alamat',
            ]);

            $kelasSiswa = KelasSiswa::create(Arr::except($data, [
                'nik',
                'nama_orang_tua',
                'hubungan',
                'pekerjaan',
                'nomor_telepon',
                'alamat',
            ]));

            $orangTua = OrangTua::create([
                'user_id' => null,
                'nik' => $orangTuaData['nik'],
                'nama' => $orangTuaData['nama_orang_tua'],
                'hubungan' => $orangTuaData['hubungan'],
                'pekerjaan' => $orangTuaData['pekerjaan'] ?? null,
                'nomor_telepon' => $orangTuaData['nomor_telepon'],
                'alamat' => $orangTuaData['alamat'] ?? null,
                'status' => $kelasSiswa->status,
            ]);

            $kelasSiswa->update(['orang_tua_id' => $orangTua->id]);

            return $kelasSiswa;
        });
    }
}
