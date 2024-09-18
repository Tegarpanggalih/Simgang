@extends('layouts.app')

@section('title', 'Daftar Siswa')

@section('content')
<h1>Selamat Datang, {{ Auth::user()->username ?? 'User' }}!</h1>
    <h2>Dashboard Sertifikat PKL (Siswa)</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Asal Sekolah</th>
                <th>NIM/NIS</th>
                <th>Jurusan</th>
                <th>Tanggal Sertifikat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sertifikats as $sertifikat)
                <tr>
                    <td>{{ $sertifikat->nama_lengkap }}</td>
                    <td>{{ $sertifikat->asal_sekolah }}</td>
                    <td>{{ $sertifikat->nim_nis }}</td>
                    <td>{{ $sertifikat->jurusan }}</td>
                    <td>{{ $sertifikat->tgl_sertifikat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection