<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use App\Models\SertifikatPKL;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $penilaians = Penilaian::when($request->has('search'), function ($query) use ($request) {
            $query->whereHas('sertifikat', function ($query) use ($request) {
                $query->where('no_sertifikat', 'LIKE', '%' . $request->search . '%');
            });
        })->paginate(10);

        return view('penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        $sertifikats = SertifikatPKL::all();
        return view('penilaian.create', compact('sertifikats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aspek' => 'required|string|max:255',
            'nilai' => 'required|numeric',
            'ket' => 'nullable|string',
            'id_sertifikat' => 'required|exists:tbl_sertifikat_pkl,id_sertifikat'
        ]);

        Penilaian::create([
            'aspek' => $request->aspek,
            'nilai' => $request->nilai,
            'ket' => $request->ket,
            'id_sertifikat' => $request->id_sertifikat
        ]);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil ditambahkan');
    }

    public function cetak($id_sertifikat)
    {
        $penilaians = Penilaian::where('id_sertifikat', $id_sertifikat)->get();
        $sertifikat = SertifikatPKL::find($id_sertifikat);

        if (!$sertifikat) {
            return redirect()->route('penilaian.index')->with('error', 'Data sertifikat tidak ditemukan.');
        }

        return view('penilaian.cetak', compact('penilaians', 'sertifikat'));
    }

    public function edit(Penilaian $penilaian)
    {
        $sertifikats = SertifikatPKL::all();
        return view('penilaian.edit', compact('penilaian', 'sertifikats'));
    }

    public function update(Request $request, Penilaian $penilaian)
    {
        $request->validate([
            'aspek' => 'required|string|max:255',
            'nilai' => 'required|numeric',
            'ket' => 'nullable|string',
            'id_sertifikat' => 'required|exists:tbl_sertifikat_pkl,id_sertifikat'
        ]);

        $penilaian->update([
            'aspek' => $request->aspek,
            'nilai' => $request->nilai,
            'ket' => $request->ket,
            'id_sertifikat' => $request->id_sertifikat
        ]);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui');
    }

    public function destroy(Penilaian $penilaian)
    {
        $penilaian->delete();
        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus');
    }

    public function exportToPDF($id_sertifikat)
    {
        $penilaians = Penilaian::where('id_sertifikat', $id_sertifikat)->get();
        $sertifikat = SertifikatPKL::find($id_sertifikat);
    
        if (!$sertifikat) {
            return redirect()->route('penilaian.index')->with('error', 'Data sertifikat tidak ditemukan.');
        }
    
        // Render HTML content
        $htmlContent = view('penilaian.cetak', compact('sertifikat', 'penilaians'))->render();
    
        // Create PDF from HTML
        $pdf = app('dompdf.wrapper')->loadView('penilaian.cetak', compact('sertifikat', 'penilaians'));
        $pdf->setPaper('A4', 'landscape')->setOption('margin',0);

        // Define file name
        $fileName = 'sertifikat_' . $sertifikat->nim_nis . '.pdf';
    
        // Download the PDF
        return $pdf->download($fileName);
    }

    public function showNilai($id_sertifikat){
        $sertifikat = SertifikatPKL::find($id_sertifikat);

        // Ambil data penilaian terkait sertifikat
        $penilaians = Penilaian::where('id_sertifikat', $id_sertifikat)->get();
    
        // Cek jika data tidak ditemukan
        if (!$sertifikat || $penilaians->isEmpty()) {
            return view('siswa.nilai')->with('error', 'Data tidak ditemukan.');
        }
    
        // Kirim data ke view
        return view('siswa.nilai', compact('sertifikat', 'penilaians'));
    }
}
