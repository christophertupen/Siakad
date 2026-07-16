<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrasiController extends Controller
{
    public function register(Request $request)
    {
        // 1. Common Validation
        $rules = [
            'role' => 'required|in:siswa,guru,orang_tua',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'nomor_hp' => 'required|string|max:20',
        ];

        $messages = [
            'role.required' => 'Peran (Role) wajib dipilih.',
            'role.in' => 'Peran yang dipilih tidak valid.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar pada sistem.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.',
        ];

        // 2. Role-specific Validation
        if ($request->role === 'siswa') {
            $rules['nis'] = 'required|string|max:50';
            $messages['nis.required'] = 'NIS wajib diisi untuk Siswa.';
        } elseif ($request->role === 'guru') {
            $rules['nip'] = 'required|string|max:50';
            $messages['nip.required'] = 'NIP wajib diisi untuk Guru.';
        } elseif ($request->role === 'orang_tua') {
            $rules['nik'] = 'required|string|max:50';
            $messages['nik.required'] = 'NIK wajib diisi untuk Orang Tua.';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // 3. Database Transaction to store records
        DB::beginTransaction();
        try {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Create registrasi request (Status is 'Pending' by default in DB)
            $extraData = $request->except(['_token', 'name', 'email', 'password', 'password_confirmation', 'role']);
            
            \App\Models\Registrasi::create([
                'user_id' => $user->id,
                'role' => $request->role,
                'status' => 'Pending',
                'extra_data' => $extraData,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil dikirim. Akun Anda sedang dalam status Pending menunggu persetujuan Admin.',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem saat menyimpan pendaftaran: ' . $e->getMessage(),
            ], 500);
        }
    }
}
