@extends('layouts.app')

@section('title', 'Tambah Sertifikat')

@section('content')
<h1>Tambah Sertifikat</h1>

<!-- Progress Bar -->
<div class="progress mb-4">
    <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Langkah 1 dari 4</div>
</div>

<form action="{{ route('mentor.store') }}" method="POST">
    @csrf

    <!-- Step 1: Data Pribadi -->
    <div id="step1" class="form-step">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Data Pribadi</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                        @error('nama_lengkap')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="asal_sekolah">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control" value="{{ old('asal_sekolah') }}" required>
                        @error('asal_sekolah')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nim_nis">NIM/NIS</label>
                        <input type="text" name="nim_nis" id="nim_nis" class="form-control" value="{{ old('nim_nis') }}" required>
                        @error('nim_nis')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
                        @error('tempat_lahir')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="{{ old('tgl_lahir') }}" required>
                        @error('tgl_lahir')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" name="jurusan" id="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
                        @error('jurusan')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <button type="button" class="btn btn-primary" onclick="nextStep(2)">Lanjut</button>
            </div>
        </div>
    </div>

    <!-- Step 2: Data Sertifikat -->
    <div id="step2" class="form-step" style="display: none;">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Data Sertifikat</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tgl_mulai">Tanggal Mulai</label>
                        <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="{{ old('tgl_mulai') }}" required>
                        @error('tgl_mulai')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="tgl_selesai">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" value="{{ old('tgl_selesai') }}" required>
                        @error('tgl_selesai')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="tgl_sertifikat">Tanggal Sertifikat</label>
                        <input type="date" name="tgl_sertifikat" id="tgl_sertifikat" class="form-control" value="{{ old('tgl_sertifikat') }}" required>
                        @error('tgl_sertifikat')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="no_sertifikat">No. Sertifikat</label>
                    <input type="text" name="no_sertifikat" id="no_sertifikat" class="form-control" value="{{ old('no_sertifikat') }}" required>
                    @error('no_sertifikat')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="button" class="btn btn-secondary" onclick="previousStep(1)">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="nextStep(3)">Lanjut</button>
            </div>
        </div>
    </div>

    <!-- Step 3: Data Pembimbing -->
    <div id="step3" class="form-step" style="display: none;">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Data Pembimbing</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nm_pembimbing">Nama Pembimbing</label>
                        <input type="text" name="nm_pembimbing" id="nm_pembimbing" class="form-control" value="{{ old('nm_pembimbing') }}" required>
                        @error('nm_pembimbing')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nik_pembimbing">NIK Pembimbing</label>
                        <input type="text" name="nik_pembimbing" id="nik_pembimbing" class="form-control" value="{{ old('nik_pembimbing') }}" required>
                        @error('nik_pembimbing')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="jabatan_pembimbing">Jabatan Pembimbing</label>
                    <input type="text" name="jabatan_pembimbing" id="jabatan_pembimbing" class="form-control" value="{{ old('jabatan_pembimbing') }}" required>
                    @error('jabatan_pembimbing')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="aprove_pembimbing">Status Persetujuan Pembimbing</label>
                    <select name="aprove_pembimbing" id="aprove_pembimbing" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="1" {{ old('aprove_pembimbing') == '1' ? 'selected' : '' }}>Disetujui</option>
                        <option value="0" {{ old('aprove_pembimbing') == '0' ? 'selected' : '' }}>Belum Disetujui</option>
                    </select>
                    @error('aprove_pembimbing')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="button" class="btn btn-secondary" onclick="previousStep(2)">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="nextStep(4)">Lanjut</button>
            </div>
        </div>
    </div>

    <!-- Step 4: Data Kepala Dinas -->
    <div id="step4" class="form-step" style="display: none;">
        <div class="card mb-4">
            <div class="card-header">
                <h5>Data Kepala Dinas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nm_kadis">Nama Kepala Dinas</label>
                        <input type="text" name="nm_kadis" id="nm_kadis" class="form-control" value="{{ old('nm_kadis') }}" required>
                        @error('nm_kadis')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nip_kadis">NIP Kepala Dinas</label>
                        <input type="text" name="nip_kadis" id="nip_kadis" class="form-control" value="{{ old('nip_kadis') }}" required>
                        @error('nip_kadis')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="approve_kadis">Status Persetujuan Kepala Dinas</label>
                    <select name="approve_kadis" id="approve_kadis" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="1" {{ old('approve_kadis') == '1' ? 'selected' : '' }}>Disetujui</option>
                        <option value="0" {{ old('approve_kadis') == '0' ? 'selected' : '' }}>Belum Disetujui</option>
                    </select>
                    @error('approve_kadis')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="sts_diambil">Status Sertifikat Diambil</label>
                    <select name="sts_diambil" id="sts_diambil" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="1" {{ old('sts_diambil') == '1' ? 'selected' : '' }}>Diambil</option>
                        <option value="0" {{ old('sts_diambil') == '0' ? 'selected' : '' }}>Belum Diambil</option>
                    </select>
                    @error('sts_diambil')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="button" class="btn btn-secondary" onclick="previousStep(3)">Kembali</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    function previousStep(step) {
        document.querySelectorAll('.form-step').forEach(function(stepDiv) {
            stepDiv.style.display = 'none';
        });
        document.getElementById('step' + step).style.display = 'block';
        updateProgressBar(step); // Update progress bar
    }

    function updateProgressBar(step) {
        const progressBar = document.getElementById('progress-bar');
        const stepTitles = ['Data Pribadi', 'Data Sertifikat', 'Data Pembimbing', 'Data Kepala Dinas'];
        const stepPercentage = (step / 4) * 100;
        progressBar.style.width = stepPercentage + '%';
        progressBar.setAttribute('aria-valuenow', stepPercentage);
        progressBar.innerHTML = `Langkah ${step} dari 4 (${stepTitles[step - 1]})`;
    }

    function saveStepData(step) {
        const inputs = document.querySelectorAll(`#step${step} input`);
        inputs.forEach(input => {
            localStorage.setItem(input.name, input.value);
        });
    }

    function loadStepData() {
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            if (localStorage.getItem(input.name)) {
                input.value = localStorage.getItem(input.name);
            }
        });
    }

    // Panggil saat berpindah step
    function nextStep(step) {
        saveStepData(step - 1); // Simpan data step sebelumnya

        // Lanjut ke langkah berikutnya
        document.querySelectorAll('.form-step').forEach(function(stepDiv) {
            stepDiv.style.display = 'none';
        });
        document.getElementById('step' + step).style.display = 'block';
        updateProgressBar(step);
    }


    // Load data ketika halaman dimuat
    // document.addEventListener('DOMContentLoaded', loadStepData);
</script>
@endsection