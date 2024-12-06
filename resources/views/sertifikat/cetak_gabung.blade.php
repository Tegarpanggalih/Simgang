<!DOCTYPE html>
<html>

<head>
    <title>Cetak Gabungan</title>
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
    </style>
</head>

<body>
    @include('mentor.cetak', ['sertifikat' => $sertifikat])

    <hr style="margin: 20px 0;">

    @include('penilaian.cetak', ['sertifikat' => $sertifikat, 'penilaians' => $penilaians])
</body>

</html>
