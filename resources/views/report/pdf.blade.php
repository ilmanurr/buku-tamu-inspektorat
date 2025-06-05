<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    @if($filterStatus === 'semua_tamu' || !$filterStatus)
    <title>Laporan Kunjungan Tamu</title>
    @else
    <title>Laporan Kartu Akses Tamu</title>
    @endif
    <style>
    @page {
        margin-top: 160px;
        margin-bottom: 60px;
    }

    body {
        font-family: 'Times New Roman', Times, serif;
        margin: 0;
        padding-top: 50px;
    }

    .header {
        position: fixed;
        top: -120px;
        left: 0;
        right: 0;
        text-align: center;
    }

    .header img {
        height: 120px;
        position: absolute;
        top: 0;
        left: 40px;
    }

    .instansi {
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .judul-laporan {
        margin-top: -20px;
        font-size: 22px;
        font-weight: bold;
        text-align: center;
    }

    .tanggal-laporan {
        text-align: center;
        font-size: 14px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 6px;
        text-align: center;
    }

    .thead-light {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .no-data {
        text-align: center;
        font-style: italic;
        padding: 10px;
    }

    hr {
        margin: 0;
        border: 0.5px solid black;
    }
    </style>

</head>

<body>
    <!-- Format header dalam laporan -->
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo-inspektorat2.png'))) }}"
            alt="Logo" style="height: 120px;">
        <div>
            <div class="instansi">PEMERINTAH PROVINSI JAWA TIMUR</div>
            <div style="font-size: 20px; font-weight: bold;">INSPEKTORAT</div>
            <div style="font-size: 14px;">
                Jalan Raya Juanda Nomor 8, Sidoarjo, Jawa Timur 61254<br>
                Tlp./Fks. (031) 85595721, Laman <u>inspektorat.jatimprov.go.id</u><br>
                Pos-el <u>itprov@jatimprov.go.id</u>
            </div>
            <br><br>
            <hr>
            <hr style="margin-top: 0.5px;">
            <br>
        </div>
    </div>

    <div class="judul-laporan">
        @if($filterStatus === 'semua_tamu' || !$filterStatus)
        Laporan Kunjungan Tamu
        @else
        Laporan Kartu Akses Tamu
        @endif
    </div>

    @if($tanggalMulai && $tanggalSelesai)
    <div class="tanggal-laporan">
        Tanggal:
        @if ($tanggalMulaiFormat === $tanggalSelesaiFormat)
        {{ $tanggalMulaiFormat }}
        @else
        {{ $tanggalMulaiFormat }} s/d {{ $tanggalSelesaiFormat }}
        @endif
    </div>
    @endif

    <!-- Tabel laporan -->
    <table>
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Tanggal / Jam Kunjungan</th>
                <th>Nama Tamu</th>
                <th>Instansi</th>
                <th>Keperluan</th>
                <th>Kartu Akses</th>
                @if($filterStatus === 'belum_kembali')
                <th>Catatan</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($report->bkd_tanggal_kunjungan)->format('d-m-Y') }}<br>
                    {{ $report->bkd_jam_kunjungan }}
                </td>
                <td>{{ $report->bkd_nama }}</td>
                <td>{{ $report->bkd_instansi }}</td>
                <td>{{ $report->bkd_keperluan }}</td>
                <td>{{ $report->bkd_kartu_akses_nama }}</td>
                @if($filterStatus === 'belum_kembali')
                <td>{{ $report->bkd_catatan ?? '' }}</td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="{{ $filterStatus === 'belum_kembali' ? 7 : 6 }}" class="no-data">
                    Tidak ada data tamu pada tanggal dan filter yang dipilih.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>