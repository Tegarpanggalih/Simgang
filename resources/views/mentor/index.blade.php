@extends('layouts.app')

@section('title', 'Daftar Sertifikat')

@section('content')

<div class="card">
    <div class="card-body">
        <h1 class="text-center">Selamat Datang Kembali, {{ Auth::user()->username ?? 'User' }}!</h1>

        <h2 class="text-center">Dashboard Sertifikat PKL (Mentor)</h2>
        <div class=" mb-3">
            <a href="{{ route('mentor.create') }}" class="btn btn-primary">Tambah Mahasiswa</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Asal Sekolah</th>
                        <th>NIM/NIS</th>
                        <th>Jurusan</th>
                        <th>Tanggal Sertifikat</th>
                        <th>Approve Pembimbing</th>
                        <th>Approve Kadis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sertifikats as $sertifikat)
                    <tr>
                        <td>{{ $sertifikat->nama_lengkap }}</td>
                        <td>{{ $sertifikat->asal_sekolah }}</td>
                        <td>{{ $sertifikat->nim_nis }}</td>
                        <td>{{ $sertifikat->jurusan }}</td>
                        <td>{{ \Carbon\Carbon::parse($sertifikat->tgl_sertifikat)->format('d-m-Y') }}</td>
                        <td>
                            <button class="btn {{ $sertifikat->aprove_pembimbing ? 'btn-success btn-sm' : 'btn-danger btn-sm' }}">
                                {{ $sertifikat->aprove_pembimbing ? 'Sudah' : 'Belum' }}
                            </button>
                        </td>
                        <td>
                            <button class="btn {{ $sertifikat->approve_kadis ? 'btn-success btn-sm' : 'btn-danger btn-sm' }}">
                                {{ $sertifikat->approve_kadis ? 'Sudah' : 'Belum' }}
                            </button>
                        </td>
                        <td class="d-flex gap-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $sertifikat->id }}">
                                Lihat
                            </button>
                            <a href="{{ route('mentor.edit', $sertifikat) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('mentor.destroy', $sertifikat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal untuk detail -->
                    <div class="modal fade" id="detailModal{{ $sertifikat->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $sertifikat->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $sertifikat->id }}">Detail Sertifikat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Data Pribadi -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Data Pribadi</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>Nama Lengkap:</strong> {{ $sertifikat->nama_lengkap }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>Asal Sekolah:</strong> {{ $sertifikat->asal_sekolah }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>NIM/NIS:</strong> {{ $sertifikat->nim_nis }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>Tempat Lahir:</strong> {{ $sertifikat->tempat_lahir }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($sertifikat->tgl_lahir)->format('d-m-Y') }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>Jurusan:</strong> {{ $sertifikat->jurusan }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data Sertifikat -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Data Sertifikat</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($sertifikat->tgl_mulai)->format('d-m-Y') }}</p>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <p><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($sertifikat->tgl_selesai)->format('d-m-Y') }}</p>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <p><strong>Tanggal Sertifikat:</strong> {{ \Carbon\Carbon::parse($sertifikat->tgl_sertifikat)->format('d-m-Y') }}</p>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <p><strong>No. Sertifikat:</strong> {{ $sertifikat->no_sertifikat }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data Pembimbing -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Data Pembimbing</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>Nama Pembimbing:</strong> {{ $sertifikat->nm_pembimbing }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>NIK Pembimbing:</strong> {{ $sertifikat->nik_pembimbing }}</p>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <p><strong>Jabatan Pembimbing:</strong> {{ $sertifikat->jabatan_pembimbing }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data Kepala Dinas -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Data Kepala Dinas</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>Nama Kepala Dinas:</strong> {{ $sertifikat->nm_kadis }}</p>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <p><strong>NIP Kepala Dinas:</strong> {{ $sertifikat->nip_kadis }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Status Persetujuan -->
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            <h5>Status Persetujuan</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <p>
                                                        <strong>Approve Pembimbing:</strong>
                                                        <br>
                                                        <button class="btn {{ $sertifikat->aprove_pembimbing ? 'btn-success' : 'btn-danger' }}">
                                                            {{ $sertifikat->aprove_pembimbing ? 'Sudah' : 'Belum' }}
                                                        </button>
                                                    </p>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <p>
                                                        <strong>Approve Kadis:</strong>
                                                        <br>
                                                        <button class="btn {{ $sertifikat->approve_kadis ? 'btn-success' : 'btn-danger' }}">
                                                            {{ $sertifikat->approve_kadis ? 'Sudah' : 'Belum' }}
                                                        </button>
                                                    </p>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <p>
                                                        <strong>Status Diambil:</strong>
                                                        <br>
                                                        <button class="btn {{ $sertifikat->sts_diambil ? 'btn-success' : 'btn-danger' }}">
                                                            {{ $sertifikat->sts_diambil ? 'Sudah' : 'Belum' }}
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection