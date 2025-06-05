@extends('layouts.app')

@section('title', 'Detail Data Tamu')

@section('content')
<style>
.table-detail {
    width: 100%;
    table-layout: fixed;
}

.table-detail td {
    padding: 5px;
    vertical-align: top;
}

.table-detail .label {
    width: 40%;
    font-weight: bold;
}

.table-detail .separator {
    width: 5%;
    text-align: center;
}
</style>

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-circle"></i> Detail Tamu</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Informasi Utama -->
                <div class="col-md-6">
                    <h5 class="mb-3"><i class="fas fa-id-badge"></i> Informasi Utama</h5>
                    <table class="table-detail">
                        @php
                        $dataUtama = [
                        'No. Tamu' => $bukuTamu->bkd_no,
                        'Identitas' => $bukuTamu->bkd_identitas,
                        'Nama' => $bukuTamu->bkd_nama,
                        'Instansi' => $bukuTamu->bkd_instansi,
                        'Keperluan' => $bukuTamu->bkd_keperluan,
                        ];
                        @endphp
                        @foreach($dataUtama as $label => $value)
                        <tr>
                            <td class="label">{{ $label }}</td>
                            <td class="separator">:</td>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <!-- Informasi Tambahan -->
                <div class="col-md-6">
                    <h5 class="mb-3"><i class="fas fa-info-circle"></i> Informasi Tambahan</h5>
                    <table class="table-detail">
                        @php
                        $dataTambahan = [
                        'Jenis Kelamin' => $bukuTamu->bkd_jenis_kelamin,
                        'Telepon' => $bukuTamu->bkd_telepon,
                        'Rombongan' => $bukuTamu->bkd_rombongan,
                        'Kartu Akses' => $bukuTamu->bkd_kartu_akses_nama,
                        'Tanggal Kunjungan' => \Carbon\Carbon::parse($bukuTamu->bkd_tanggal_kunjungan)->format('d-m-Y'),
                        'Jam Kunjungan' => $bukuTamu->bkd_jam_kunjungan,
                        ];
                        @endphp
                        @foreach($dataTambahan as $label => $value)
                        <tr>
                            <td class="label">{{ $label }}</td>
                            <td class="separator">:</td>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection