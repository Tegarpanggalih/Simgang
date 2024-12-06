@extends('layouts.app')

@section('title', 'Tambah Penilaian')

@section('content')
    <div class="container mt-4">
        <h1>Form Penilaian</h1>
        <form action="{{ route('penilaian.store') }}" method="POST">
            @csrf

            <div class="card mb-4">
                <div class="card-header">
                    <h5>Tambah Penilaian</h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        <!-- Aspek Penilaian -->
                        <div class="col-md-6 mb-3">
                            <label for="aspek" class="form-label">Aspek Penilaian</label>
                            <input type="text" class="form-control" id="aspek" name="aspek" required>
                        </div>

                        <!-- Nilai -->
                        <div class="col-md-6 mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" class="form-control" id="nilai" name="nilai" required>
                        </div>

                        <!-- Sertifikat -->
                        <div class="col-md-6 mb-3">
                            <label for="id_sertifikat" class="form-label">No Sertifikat</label>
                            <select class="form-control" id="id_sertifikat" name="id_sertifikat" required>
                                <option value="">--pilih--</option>
                                @foreach ($sertifikats as $sertifikat)
                                    <option value="{{ $sertifikat->id_sertifikat }}">{{ $sertifikat->no_sertifikat }} -
                                        {{ $sertifikat->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Keterangan -->
                        <div class="col-md-6 mb-3">
                            <label for="ket" class="form-label">Keterangan</label>
                            <select class="form-control" id="ket" name="ket">
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

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-warning" href="{{ route('penilaian.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endsection
