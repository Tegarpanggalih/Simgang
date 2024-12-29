<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\SertifikatPKL;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class SertifikatController extends Controller
{

    public function dashboard()
    {
        return view('mentor.dashboard');
    }

    public function index(Request $request)
    {
        $role = Auth::user()->role;

        if ($role == 'siswa') {

            $user = Auth::user();
            $sertifikats = SertifikatPKL::where('nim_nis', $user->username)
                ->when($request->has('search'), function ($query) use ($request) {
                    $query->where('nama_lengkap', 'LIKE', '%' . $request->search . '%');
                })->paginate(10);

            return view('siswa.dashboard', compact('sertifikats'));
        } elseif ($role == 'mentor') {

            $sertifikats = SertifikatPKL::when($request->has('search'), function ($query) use ($request) {
                $query->where('nama_lengkap', 'LIKE', '%' . $request->search . '%');
            })->paginate(10);
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
        // Log::info('Store request data:', $request->all());
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
            'bidang' => 'required|string|max:50',
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

    public function cetak(SertifikatPKL $sertifikat)
    {
        $data = array('id' => $sertifikat);
        return view('mentor.cetak', compact('sertifikat'));
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
            'bidang' => 'required|string|max:50',
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

    public function cetakPDF(SertifikatPKL $sertifikat)
    {
        // Cek jika sertifikat tidak ditemukan
        if (!$sertifikat) {
            return redirect()->route('mentor.index')->with('error', 'Data sertifikat tidak ditemukan.');
        }

        $htmlContent = view('mentor.cetak', compact('sertifikat'))->render();

        $pdf = app('dompdf.wrapper')->loadView('mentor.cetak', compact('sertifikat'));
        $pdf->setPaper('A4', 'landscape')->setOption('margin',0);

        // Nama file PDF
        $fileName = 'sertifikat_' . $sertifikat->nim_nis . '.pdf';

        // Download file PDF
        return $pdf->download($fileName);
    }

    public function cetakGabung($id){

    $sertifikat = SertifikatPKL::findOrFail($id);
    $penilaians = Penilaian::where('id_sertifikat', $id)->get();

    $htmlContent = view('sertifikat.cetak_gabung', compact('sertifikat', 'penilaians'))->render();

    $pdf = app('dompdf.wrapper');
    $pdf->loadHTML($htmlContent);

    $pdf->setPaper('A4', 'portrait');
    $fileName = 'sertifikat_' . $sertifikat->nama_lengkap . '.pdf';

    return $pdf->download($fileName);
    }
}
