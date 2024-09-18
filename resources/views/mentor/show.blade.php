@extends('layouts.app')

@section('title', 'Detail Sertifikat')

@section('content')
    <h1 class="mb-4">Detail Sertifikat</h1>

    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4">{{ $sertifikat->nama_lengkap }}</h2>

            <!-- Informasi Umum -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Asal Sekolah:</strong> {{ $sertifikat->asal_sekolah }}</p>
                    <p><strong>NIM/NIS:</strong> {{ $sertifikat->nim_nis }}</p>
                    <p><strong>Tempat Lahir:</strong> {{ $sertifikat->tempat_lahir }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($sertifikat->tgl_lahir)->format('d-m-Y') }}</p>
                    <p><strong>Jurusan:</strong> {{ $sertifikat->jurusan }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($sertifikat->tgl_mulai)->format('d-m-Y') }}</p>
                    <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($sertifikat->tgl_selesai)->format('d-m-Y') }}</p>
                    <p><strong>Tanggal Sertifikat:</strong> {{ \Carbon\Carbon::parse($sertifikat->tgl_sertifikat)->format('d-m-Y') }}</p>
                </div>
            </div>

            <!-- Pembimbing -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Nama Pembimbing:</strong> {{ $sertifikat->nm_pembimbing }}</p>
                    <p><strong>NIK Pembimbing:</strong> {{ $sertifikat->nik_pembimbing }}</p>
                    <p><strong>Jabatan Pembimbing:</strong> {{ $sertifikat->jabatan_pembimbing }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>No Sertifikat:</strong> {{ $sertifikat->no_sertifikat }}</p>
                </div>
            </div>

            <!-- Kadis -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Nama Kadis:</strong> {{ $sertifikat->nm_kadis }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>NIP Kadis:</strong> {{ $sertifikat->nip_kadis }}</p>
                </div>
            </div>

            <!-- Status Approval -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <p>
                        <strong>Approve Pembimbing:</strong>
                        <br>
                        <button class="btn {{ $sertifikat->aprove_pembimbing ? 'btn-success' : 'btn-danger' }}">
                            {{ $sertifikat->aprove_pembimbing ? 'Sudah' : 'Belum' }}
                        </button>
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <strong>Approve Kadis:</strong>
                        <br>
                        <button class="btn {{ $sertifikat->approve_kadis ? 'btn-success' : 'btn-danger' }}">
                            {{ $sertifikat->approve_kadis ? 'Sudah' : 'Belum' }}
                        </button>
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <strong>Status Diambil:</strong>
                        <br>
                        <button class="btn {{ $sertifikat->sts_diambil ? 'btn-success' : 'btn-danger' }}">
                            {{ $sertifikat->sts_diambil ? 'Sudah' : 'Belum' }}
                        </button>
                    </p>
                </div>
            </div>

            <!-- Kembali Button -->
            <a href="{{ route('mentor.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
