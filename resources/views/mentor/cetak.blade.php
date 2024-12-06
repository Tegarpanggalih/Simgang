<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            size: A4 landscape;
            margin: 15mm;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            width: 150px;
            height: auto;
        }

        .certificate-title {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            text-decoration: underline;
        }

        .certificate-nomor {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .nama {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }

        .center-table {
            width: 80%;
            margin: 0 auto;
            font-size: 12px;
        }

        .center-table td {
            padding: 5px 10px;
            vertical-align: top;
        }

        .kata-2 {
            text-align: center;
            font-size: 12px;
            line-height: 1.5;
            margin: 20px 0;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: 40px;
            font-size: 12px;
        }

        .signature {
            text-align: center;
            font-size: 12px;
            width: 40%;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .signature-details {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php
    $tgl_lahir = new DateTime($sertifikat->tgl_lahir);
    $tgl_mulai = new DateTime($sertifikat->tgl_mulai);
    $tgl_selesai = new DateTime($sertifikat->tgl_selesai);
    
    $format_tgl_lahir = $tgl_lahir->format('Y-m-d');
    $format_tgl_mulai = $tgl_mulai->format('Y-m-d');
    $format_tgl_selesai = $tgl_selesai->format('Y-m-d');
    
    $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    $ex = explode('-', $format_tgl_lahir);
    $ex2 = explode('-', $format_tgl_mulai);
    $ex3 = explode('-', $format_tgl_selesai);
    ?>
    <div class="background"></div>
    <div class="container">
        <div class="header">
            <img class="logo" src="{{ public_path('images/logo-dinascilacap.png') }}" alt="Logo Dinas Cilacap">
            <div>
                <h1 class="certificate-title">S E R T I F I K A T</h1>
                <p class="certificate-nomor">NOMOR: <?= $sertifikat->no_sertifikat ?></p>
            </div>
        </div>

        <p class="kata-2">
            Diberikan oleh Kepala Dinas Komunikasi dan Informatika Kabupaten Cilacap untuk menerangkan bahwa:
        </p>

        <h2 class="nama"><?= $sertifikat->nama_lengkap ?></h2>

        <table class="center-table">
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>: <?= $sertifikat->tempat_lahir . ', ' . $ex[2] . ' ' . $bulan[(int) $ex[1]] . ' ' . $ex[0] ?></td>
            </tr>
            <tr>
                <td>NPIS/NIM</td>
                <td>: <?= $sertifikat->nim_nis ?></td>
            </tr>
            <tr>
                <td>Paket Keahlian</td>
                <td>: <?= $sertifikat->jurusan ?></td>
            </tr>
            <tr>
                <td>Sekolah/Perguruan Tinggi</td>
                <td>: <?= $sertifikat->asal_sekolah ?></td>
            </tr>
        </table>

        <p class="kata-2">
            Telah melaksanakan Magang Mandiri pada Dinas Komunikasi dan Informatika Kabupaten Cilacap, terhitung mulai
            tanggal <?= $ex2[2] . ' ' . $bulan[(int) $ex2[1]] . ' ' . $ex2[0] ?> sampai dengan
            <?= $ex3[2] . ' ' . $bulan[(int) $ex3[1]] . ' ' . $ex3[0] ?>,
            dan yang bersangkutan memiliki keterampilan serta kemampuan sebagai tenaga Teknik Informatika.
        </p>

        <div class="signature-section">
            <table style="width: 100%; text-align: center; margin-top: 40px;">
                <tr>
                    <!-- Kolom Kepala Dinas -->
                    <td style="width: 50%; vertical-align: top;">
                        Kepala Dinas Komunikasi dan Informatika<br>
                        Kabupaten Cilacap<br><br><br><br>
                        <span class="signature-name">SUPRIYANTO, S.H., M.Si.</span><br>
                        <span class="signature-details">Pembina Utama Muda<br>NIP. 19650825 199403 1 009</span>
                    </td>

                    <!-- Kolom Pembimbing -->
                    <td style="width: 50%; vertical-align: top;">
                        Cilacap, <?= now()->format('d F Y') ?><br>
                        Pembimbing Lapangan<br><br><br><br>
                        <span class="signature-name"><?= $sertifikat->nm_pembimbing ?></span><br>
                        <span class="signature-details">NIP. <?= $sertifikat->nik_pembimbing ?></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
