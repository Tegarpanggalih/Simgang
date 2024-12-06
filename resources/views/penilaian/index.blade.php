@extends('layouts.app')

@section('title', 'Penilaian')

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
        }
    </style>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h1 class="mb-4 text-center">Daftar Penilaian Siswa / Mahasiswa</h1>


                <div class="d-flex justify-content-between align-items-center  mt-5 mb-3">
                    <a href="{{ route('penilaian.create') }}" class="btn btn-primary btn-sm">Tambah Penilaian</a>
                    <div class="col-auto ">
                        <form action="{{ route('penilaian.index') }}" method="GET">
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
                                <th class="text-nowrap">Aspek</th>
                                <th class="text-nowrap">Nilai</th>
                                <th class="text-nowrap">Keterangan</th>
                                <th class="text-nowrap">ID Sertifikat</th>
                                <th class="text-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penilaians as $penilaian)
                                <tr>
                                    <td class="text-nowrap">
                                        {{ ($penilaians->currentPage() - 1) * $penilaians->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="text-nowrap">{{ $penilaian->aspek }}</td>
                                    <td class="text-nowrap">{{ $penilaian->nilai }}</td>
                                    <td class="text-nowrap">{{ $penilaian->ket }}</td>
                                    <td class="text-nowrap">{{ $penilaian->sertifikat->no_sertifikat }}</td>

                                    <td class="d-flex gap-2">
                                        {{-- <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $penilaians->id }}">
                                Lihat
                            </button> --}}
                                        <a href="{{ route('penilaian.edit', $penilaian->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('export.pdf', $penilaian->id_sertifikat) }}"
                                            class="btn btn-warning btn-sm">Cetak</a>
                                        {{-- <a href="{{ route('penilaian.cetak', $penilaian->id_sertifikat) }}"
                                            class="btn btn-warning btn-sm">Cetak</a> --}}
                

                                        <form action="{{ route('penilaian.destroy', $penilaian->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $penilaians->links() }}
                </div>
            </div>
        </div>

    @endsection
