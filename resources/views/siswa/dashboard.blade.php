@extends('layouts.app')

@section('title', 'Detail Siswa')

@section('content')

    <style>
        .container {
            border: 1px solid var(--line-clr);
            padding-top: 2px;
        }
    </style>

    <main>
        <div class="container">
            <h2 class="">Halo!</h2>
            <h3 class="">Selamat Datang Kembali, {{ Auth::user()->username ?? 'User' }}!</h3>
        </div>
        <div class="container">
            <h2>SIMGANG</h2>
            <p>SIMGANG adalah sistem informasi magang yang bertujuan untuk menilai siswa / mahasiswa yang sedang
                melaksanakan kegiatan magang</p>
        </div>
        <div class="container">
            <h2>Detail Siswa</h2>
            @if ($sertifikats && !$sertifikats->isEmpty())
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
    </main>

@endsection
