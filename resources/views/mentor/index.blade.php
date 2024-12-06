@extends('layouts.app')

@section('title', 'Daftar Sertifikat')

@section('content')

    <style>
        /* Aturan untuk ukuran tabel umum */
        table.table-sm {
            font-size: 0.8rem;
            /* Ukuran font untuk tampilan normal */
        }

        .table-sm th,
        .table-sm td {
            padding: 0.4rem;
            /* Padding untuk tampilan normal */
        }

        .btn-sm {
            font-size: 0.8rem;
            /* Ukuran font tombol untuk tampilan normal */
            padding: 0.3rem 0.5rem;
            /* Padding tombol untuk tampilan normal */
        }

        .table-sm .text-nowrap {
            white-space: nowrap;
        }

        /* Media query untuk tampilan mobile dengan lebar maksimal 600px */
        @media (max-width: 600px) {
            table.table-sm {
                font-size: 0.6rem;
                /* Perkecil ukuran font di mobile */
            }

            .table-sm th,
            .table-sm td {
                padding: 0.2rem;
                /* Kurangi padding di mobile */
            }

            .btn-sm {
                font-size: 0.6rem;
                /* Perkecil ukuran font tombol di mobile */
                padding: 0.2rem 0.4rem;
                /* Kurangi padding tombol di mobile */
            }

            /* Atur ulang tombol agar lebih rapat di mobile */
            .d-flex.gap-2 {
                gap: 0.3rem;
                /* Kurangi jarak antar tombol di mobile */
            }

            .pagination-sm .page-link {
                font-size: 0.6rem;
                padding: 0.2rem 0.4rem;
            }

            .pagination-sm .page-item {
                margin: 0 0.2rem;
            }
        }
    </style>

    @if ($errors->any())
        <script>
            // Open the modal if there are validation errors
            $(document).ready(function() {
                $('#penilaianModal{{ old('id_sertifikat') }}').modal('show');
            });
        </script>
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="container mt-4">
        <div class="card">
            <div class="card-body">

                <h2 class="text-center">Data Siswa / Mahasiswa PKL</h2>

                <div class="d-flex justify-content-between align-items-center  mt-5 mb-3">
                    <a href="{{ route('mentor.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                    <div class="col-auto ">
                        <form action="{{ route('mentor.index') }}" method="GET">
                            <input name="search" type="search" id="" class="form-control" placeholder="Cari Data"
                                value="{{ request('search') }}">
                        </form>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th class="text-nowrap">No</th>
                                <th class="text-nowrap">Nama</th>
                                <th class="text-nowrap">Sekolah</th>
                                <th class="text-nowrap">Bidang</th>
                                <th class="text-nowrap">Tgl Sertifikat</th>
                                <th class="text-nowrap">Pembimbing</th>
                                <th class="text-nowrap">Kadis</th>
                                <th class="text-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sertifikats as $sertifikat)
                                <tr>
                                    <td class="text-nowrap">
                                        {{ ($sertifikats->currentPage() - 1) * $sertifikats->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="text-nowrap">{{ $sertifikat->nama_lengkap }}</td>
                                    <td class="text-nowrap">{{ $sertifikat->asal_sekolah }}</td>
                                    <td class="text-nowrap">{{ $sertifikat->bidang }}</td>
                                    <td class="text-nowrap">{{ $sertifikat->tgl_sertifikat->format('d-m-Y') }}</td>
                                    <td>
                                        <button
                                            class="btn {{ $sertifikat->aprove_pembimbing ? 'btn-success btn-sm' : 'btn-danger btn-sm' }}">
                                            {{ $sertifikat->aprove_pembimbing ? 'Sudah' : 'Belum' }}
                                        </button>
                                    </td>
                                    <td>
                                        <button
                                            class="btn {{ $sertifikat->approve_kadis ? 'btn-success btn-sm' : 'btn-danger btn-sm' }}">
                                            {{ $sertifikat->approve_kadis ? 'Sudah' : 'Belum' }}
                                        </button>
                                    </td>
                                    <td class="d-flex gap-2">
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#detailModal{{ $sertifikat->id_sertifikat }}">
                                            Lihat
                                        </button>
                                        <a href="{{ route('mentor.edit', $sertifikat->id_sertifikat) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        {{-- <a href="{{ route('sertifikat.cetak', $sertifikat) }}"
                                            class="btn btn-warning btn-sm">Cetak</a> --}}
                                        <a href="{{ route('sertifikat.cetak-gabungan', $sertifikat->id_sertifikat) }}"
                                            class="btn btn-warning btn-sm">Cetak</a>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#penilaianModal{{ $sertifikat->id_sertifikat }}">
                                            Penilaian
                                        </button>
                                        <form action="{{ route('mentor.destroy', $sertifikat->id_sertifikat) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>


                                <!-- Modal for Penilaian -->
                                <div class="modal fade" id="penilaianModal{{ $sertifikat->id_sertifikat }}" tabindex="-1"
                                    aria-labelledby="penilaianModalLabel{{ $sertifikat->id_sertifikat }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('penilaian.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="penilaianModalLabel{{ $sertifikat->id_sertifikat }}">Tambah
                                                        Penilaian</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Hidden input for id_sertifikat -->
                                                    <input type="hidden" name="id_sertifikat"
                                                        value="{{ $sertifikat->id_sertifikat }}">

                                                    <!-- Aspek Penilaian -->
                                                    <div class="mb-3">
                                                        <label for="aspek{{ $sertifikat->id_sertifikat }}"
                                                            class="form-label">Aspek Penilaian</label>
                                                        <input type="text" class="form-control"
                                                            id="aspek{{ $sertifikat->id_sertifikat }}" name="aspek"
                                                            value="{{ old('aspek') }}" required>
                                                    </div>

                                                    <!-- Nilai -->
                                                    <div class="mb-3">
                                                        <label for="nilai{{ $sertifikat->id_sertifikat }}"
                                                            class="form-label">Nilai</label>
                                                        <input type="number" class="form-control"
                                                            id="nilai{{ $sertifikat->id_sertifikat }}" name="nilai"
                                                            value="{{ old('nilai') }}" required>
                                                    </div>

                                                    <!-- Keterangan -->
                                                    <div class="mb-3">
                                                        <label for="ket{{ $sertifikat->id_sertifikat }}"
                                                            class="form-label">Keterangan</label>
                                                        <select class="form-control"
                                                            id="ket{{ $sertifikat->id_sertifikat }}"
                                                            name="ket">{{ old('ket') }}
                                                            <option value="">--Pilih Keterangan--</option>
                                                            <option value="A">A</option>
                                                            <option value="AB">AB</option>
                                                            <option value="B">B</option>
                                                            <option value="BC">BC</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                            <option value="E">E</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary btn-sm">Simpan
                                                        Penilaian</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal untuk detail -->
                                <div class="modal fade" id="detailModal{{ $sertifikat->id_sertifikat }}" tabindex="-1"
                                    aria-labelledby="detailModalLabel{{ $sertifikat->id_sertifikat }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="detailModalLabel{{ $sertifikat->id_sertifikat }}"
                                                    style="font-size: 1rem;">Detail Sertifikat</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body"
                                                style="max-height: 400px; overflow-y: auto; font-size: 0.9rem; padding: 1rem;">
                                                <!-- Data Pribadi -->
                                                <div class="card mb-2">
                                                    <div class="card-header">
                                                        <h5 style="font-size: 1rem;">Data Pribadi</h5>
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>Nama Lengkap:</strong>
                                                                    <small>{{ $sertifikat->nama_lengkap }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>Asal Sekolah:</strong>
                                                                    <small>{{ $sertifikat->asal_sekolah }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>NIM/NIS:</strong>
                                                                    <small>{{ $sertifikat->nim_nis }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>Tempat Lahir:</strong>
                                                                    <small>{{ $sertifikat->tempat_lahir }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>Tanggal Lahir:</strong>
                                                                    <small>{{ $sertifikat->tgl_lahir->format('d-m-Y') }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>Jurusan:</strong>
                                                                    <small>{{ $sertifikat->jurusan }}</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Data Sertifikat -->
                                                <div class="card mb-2">
                                                    <div class="card-header">
                                                        <h5 style="font-size: 1rem;">Data Sertifikat</h5>
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <p class="mb-1"><strong>Tanggal Mulai:</strong>
                                                                    <small>{{ $sertifikat->tgl_mulai->format('d-m-Y') }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <p class="mb-1"><strong>Tanggal Selesai:</strong>
                                                                    <small>{{ $sertifikat->tgl_selesai->format('d-m-Y') }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <p class="mb-1"><strong>Tanggal Sertifikat:</strong>
                                                                    <small>{{ $sertifikat->tgl_sertifikat->format('d-m-Y') }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <p class="mb-1"><strong>No. Sertifikat:</strong>
                                                                    <small>{{ $sertifikat->no_sertifikat }}</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Data Pembimbing -->
                                                <div class="card mb-2">
                                                    <div class="card-header">
                                                        <h5 style="font-size: 1rem;">Data Pembimbing</h5>
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>Nama Pembimbing:</strong>
                                                                    <small>{{ $sertifikat->nm_pembimbing }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>NIK Pembimbing:</strong>
                                                                    <small>{{ $sertifikat->nik_pembimbing }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <p class="mb-1"><strong>Jabatan Pembimbing:</strong>
                                                                    <small>{{ $sertifikat->jabatan_pembimbing }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <p class="mb-1"><strong>Bidang:</strong>
                                                                    <small>{{ $sertifikat->bidang }}</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Data Kepala Dinas -->
                                                <div class="card mb-2">
                                                    <div class="card-header">
                                                        <h5 style="font-size: 1rem;">Data Kepala Dinas</h5>
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>Nama Kepala Dinas:</strong>
                                                                    <small>{{ $sertifikat->nm_kadis }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-6 mb-2">
                                                                <p class="mb-1"><strong>NIP Kepala Dinas:</strong>
                                                                    <small>{{ $sertifikat->nip_kadis }}</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Status Persetujuan -->
                                                <div class="card mb-2">
                                                    <div class="card-header">
                                                        <h5 style="font-size: 1rem;">Status Persetujuan</h5>
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <div class="row">
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <p class="mb-1">
                                                                    <strong>Approve Pembimbing:</strong>
                                                                    <br>
                                                                    <button
                                                                        class="btn {{ $sertifikat->aprove_pembimbing ? 'btn-success btn-sm' : 'btn-danger btn-sm' }}">
                                                                        {{ $sertifikat->aprove_pembimbing ? 'Sudah' : 'Belum' }}
                                                                    </button>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <p class="mb-1">
                                                                    <strong>Approve Kadis:</strong>
                                                                    <br>
                                                                    <button
                                                                        class="btn {{ $sertifikat->approve_kadis ? 'btn-success btn-sm' : 'btn-danger btn-sm' }}">
                                                                        {{ $sertifikat->approve_kadis ? 'Sudah' : 'Belum' }}
                                                                    </button>
                                                                </p>
                                                            </div>
                                                            <div class="col-12 col-md-4 mb-2">
                                                                <p class="mb-1">
                                                                    <strong>Status Diambil:</strong>
                                                                    <br>
                                                                    <button
                                                                        class="btn {{ $sertifikat->sts_diambil ? 'btn-success btn-sm' : 'btn-danger btn-sm' }}">
                                                                        {{ $sertifikat->sts_diambil ? 'Sudah' : 'Belum' }}
                                                                    </button>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sertifikats->onEachSide(1)->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
                </div>
            </div>
        </div>
    </div>

@endsection
