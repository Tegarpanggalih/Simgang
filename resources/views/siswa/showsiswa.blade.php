@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <h1 class="text-center">Selamat Datang, {{ Auth::user()->username ?? 'User' }}!</h1>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="mb-0">Detail Siswa</h2>
    </div>
    <div class="card-body">
        @if($sertifikats && !$sertifikats->isEmpty())
            @foreach ($sertifikats as $sertifikat)
                <div class="mb-3">
                    <p><strong>NIM:</strong> {{ $sertifikat->nim_nis }}</p>
                    <p><strong>Nama:</strong> {{ $sertifikat->nama_lengkap }}</p>
                    <p><strong>Asal Sekolah:</strong> {{ $sertifikat->asal_sekolah }}</p>
                    <p><strong>Jurusan:</strong> {{ $sertifikat->jurusan }}</p>
                    <p><strong>Tanggal Sertifikat:</strong> {{ $sertifikat->tgl_sertifikat }}</p>
                </div>
            @endforeach
        @else
            <p class="text-muted">Tidak ada sertifikat yang ditemukan.</p>
        @endif
    </div>
</div>
@endsection
