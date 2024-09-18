<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SertifikatPKL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikats = SertifikatPKL::all();
        $role = Auth::user()->role;

        if ($role == 'siswa') {

            $user = Auth::user();
            $sertifikats = SertifikatPKL::where('nim_nis', $user->username)->get();
            Log::info('Sertifikats for user:', ['sertifikats' => $sertifikats]);

            return view('siswa.showsiswa', compact('sertifikats'));
        } elseif ($role == 'mentor') {

        $sertifikats = SertifikatPKL::all();
            return view('mentor.index', compact('sertifikats'));
        }
        return abort(403, 'Unauthorized action.');
    }

    public function create()
    {
        return view('mentor.create');
    }

    public function store(Request $request)
    {
        Log::info('Store request data:', $request->all());
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'asal_sekolah' => 'required|string|max:50',
            'nim_nis' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jurusan' => 'required|string|max:100',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'tgl_sertifikat' => 'required|date',
            'nm_pembimbing' => 'required|string|max:50',
            'nik_pembimbing' => 'required|string|max:20',
            'jabatan_pembimbing' => 'required|string|max:50',
            'no_sertifikat' => 'required|string|max:50',
            'nm_kadis' => 'required|string|max:50',
            'nip_kadis' => 'required|string|max:20',
            'aprove_pembimbing' => 'required|integer',
            'approve_kadis' => 'required|integer',
            'sts_diambil' => 'required|integer',
        ]);

        SertifikatPKL::create($validatedData);

        return redirect()->route('mentor.index')->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function show(SertifikatPKL $sertifikat)
    {
        return view('mentor.show', compact('sertifikat'));
    }

    public function edit(SertifikatPKL $sertifikat)
    {
        return view('mentor.edit', compact('sertifikat'));
    }

    public function update(Request $request, SertifikatPKL $sertifikat)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'asal_sekolah' => 'required|string|max:50',
            'nim_nis' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'jurusan' => 'required|string|max:100',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'tgl_sertifikat' => 'required|date',
            'nm_pembimbing' => 'required|string|max:50',
            'nik_pembimbing' => 'required|string|max:20',
            'jabatan_pembimbing' => 'required|string|max:50',
            'no_sertifikat' => 'required|string|max:50',
            'nm_kadis' => 'required|string|max:50',
            'nip_kadis' => 'required|string|max:20',
            'aprove_pembimbing' => 'required|integer',
            'approve_kadis' => 'required|integer',
            'sts_diambil' => 'required|integer',
        ]);

        $sertifikat->update($validatedData);

        return redirect()->route('mentor.index')->with('success', 'Sertifikat berhasil diperbarui.');
    }

    public function destroy(SertifikatPKL $sertifikat)
    {
        $sertifikat->delete();

        return redirect()->route('mentor.index')->with('success', 'Sertifikat berhasil dihapus.');
    }
}

