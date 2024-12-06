@extends('layouts.app')

@section('title', 'Edit Penilaian')

@section('content')

    <div class="container mt-4">
        <h1>Edit Penilaian</h1>

        <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Edit Penilaian</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="aspek" class="form-label">Aspek</label>
                            <input type="text" class="form-control" id="aspek" name="aspek"
                                value="{{ old('aspek', $penilaian->aspek) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" class="form-control" id="nilai" name="nilai"
                                value="{{ old('nilai', $penilaian->nilai) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="ket" class="form-label">Keterangan</label>
                            <select class="form-control" id="ket" name="ket">
                                <option value="">--Pilih Keterangan--</option>
                                <option value="A" {{ old('ket', $penilaian->ket) == 'A' ? 'selected' : '' }}>A</option>
                                <option value="AB" {{ old('ket', $penilaian->ket) == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="B" {{ old('ket', $penilaian->ket) == 'B' ? 'selected' : '' }}>B</option>
                                <option value="BC" {{ old('ket', $penilaian->ket) == 'BC' ? 'selected' : '' }}>BC</option>
                                <option value="C" {{ old('ket', $penilaian->ket) == 'C' ? 'selected' : '' }}>C</option>
                                <option value="D" {{ old('ket', $penilaian->ket) == 'D' ? 'selected' : '' }}>D</option>
                                <option value="E" {{ old('ket', $penilaian->ket) == 'Epp ' ? 'selected' : '' }}>E</option>
                                
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="id_sertifikat" class="form-label">ID Sertifikat</label>
                            <select name="id_sertifikat" id="id_sertifikat" class="form-control" required>
                                @foreach ($sertifikats as $sertifikat)
                                    <option value="{{ $sertifikat->id_sertifikat }}"
                                        {{ $penilaian->id_sertifikat == $sertifikat->id_sertifikat ? 'selected' : '' }}>
                                        {{ $sertifikat->no_sertifikat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-warning" href="{{ route('penilaian.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
