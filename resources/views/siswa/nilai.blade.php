@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Data Nilai</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($penilaians->isNotEmpty())
            <h3>Nilai Penilaian</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Aspek</th>
                        <th>Nilai</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penilaians as $penilaian)
                        <tr>
                            <td>{{ $penilaian->aspek }}</td>
                            <td>{{ $penilaian->nilai }}</td>
                            <td>{{ $penilaian->ket }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data penilaian.</p>
        @endif
    </div>
@endsection
