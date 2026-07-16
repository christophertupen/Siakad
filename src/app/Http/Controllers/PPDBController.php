<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PPDBController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'berkas' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240', // Max 10MB
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'jurusan.required' => 'Jurusan wajib dipilih.',
            'berkas.required' => 'Berkas pendaftaran wajib diunggah.',
            'berkas.file' => 'Berkas harus berupa file.',
            'berkas.mimes' => 'Berkas harus berformat PDF, JPG, JPEG, PNG, DOC, atau DOCX.',
            'berkas.max' => 'Ukuran berkas tidak boleh lebih dari 10 MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $path = null;
        if ($request->hasFile('berkas')) {
            $path = $request->file('berkas')->store('ppdb', 'public');
        }

        $pendaftaran = Pendaftaran::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'asal_sekolah' => $request->asal_sekolah,
            'jurusan' => $request->jurusan,
            'berkas' => $path,
            'status' => 'Pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran Anda berhasil diajukan! Tim kami akan melakukan verifikasi.',
            'data' => $pendaftaran,
        ]);
    }
}
