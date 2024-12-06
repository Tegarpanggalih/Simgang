@extends('layouts.app')

@section('title', 'Dashboard')

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
      <p>SIMGANG adalah sistem informasi magang yang bertujuan untuk menilai siswa / mahasiswa yang sedang melaksanakan kegiatan magang</p>
    </div>
   
  </main>


@endsection