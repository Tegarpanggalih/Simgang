<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            size: A4 landscape;
            margin: 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .background {
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ public_path('images/bg-sertif.png') }}');
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            position: absolute;
            z-index: -1;
        }

        .container {
            width: 100%;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.95);
            box-sizing: border-box;
        }

        .title {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 12px;
        }

        .header-info {
            text-align: center;
            margin-bottom: 11px;
        }

        .header-info table {
            margin: 0 auto;
            font-size: 11px;
        }

        .header-info td {
            padding: 2px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 30px;
            font-size: 10px;
        }

        .footer-left {
            width: 50%;
        }

        .footer-left table {
            border: 1px solid #000;
            width: fit-content;
            font-size: 10px;
        }

        .footer-left td {
            padding: 5px;
        }

        .footer-right {
            margin-top: 20px;
            text-align: right;

            font-size: 10px;
        }

        .signature {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <div class="background"></div>

    <div class="container">
        <h2 class="title">DAFTAR NILAI<br>HASIL PELAKSANAAN<br>Praktik Kerja Lapangan</h2>

        <div class="header-info">
            <table>
                <tr>
                    <td>Nama Siswa/Mahasiswa</td>
                    <td>: {{ $sertifikat->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td>NIS/NIM</td>
                    <td>: {{ $sertifikat->nim_nis }}</td>
                </tr>
                <tr>
                    <td>Jurusan</td>
                    <td>: {{ $sertifikat->jurusan }}</td>
                </tr>
                <tr>
                    <td>Sekolah/Perguruan Tinggi</td>
                    <td>: {{ $sertifikat->asal_sekolah }}</td>
                </tr>
            </table>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ASPEK YANG DINILAI</th>
                    <th>NILAI</th>
                    <th>KETERANGAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penilaians as $index => $penilaian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="text-align: left;">{{ $penilaian->aspek }}</td>
                        <td>{{ $penilaian->nilai }}</td>
                        <td>{{ $penilaian->ket ?? '-' }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Rata-rata</strong></td>
                    <td colspan="2">{{ number_format($penilaians->avg('nilai'), 2) }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Predikat</strong></td>
                    <td colspan="2">
                        @php
                            $avg = $penilaians->avg('nilai');
                            if ($avg >= 90) {
                                echo 'Sangat Baik (A)';
                            } elseif ($avg >= 75) {
                                echo 'Baik (B)';
                            } elseif ($avg >= 60) {
                                echo 'Cukup (C)';
                            } else {
                                echo 'Kurang (D)';
                            }
                        @endphp
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <table style="width: 100%; text-align: center; margin-top: 40px; border-spacing: 0;">
                <tr>
                    
                    <td class="footer-left"
                        style="width: 50%; vertical-align: top; text-align: left; ">
                        <table style="width: 50%; border-spacing: 0;">
                            <tr>
                                <td style="font-weight: bold;">Kategori Nilai</td>
                            </tr>
                            <tr>
                                <td>90,00 - 100</td>
                                <td>= Sangat Baik (A)</td>
                            </tr>
                            <tr>
                                <td>75,00 - 89,99</td>
                                <td>= Baik (B)</td>
                            </tr>
                            <tr>
                                <td>60,00 - 74,99</td>
                                <td>= Cukup (C)</td>
                            </tr>
                            <tr>
                                <td>00,00 - 59,00</td>
                                <td>= Kurang (D)</td>
                            </tr>
                        </table>
                    </td>

                    
                    <td class="footer-right" style="width: 50%; vertical-align: top; text-align: right;">
                        <p>Cilacap, <?= now()->format('d F Y') ?></p>
                        <p>Pembimbing Lapangan</p>
                        <br><br><br>
                        <p style="font-weight: bold; text-align: right; margin-top: 40px;">
                            <?= $sertifikat->nm_pembimbing ?>
                        </p>
                    </td>
                </tr>
            </table>
        </div>


    </div>
</body>

</html>
