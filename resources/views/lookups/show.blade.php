@extends('layouts.app')

@section('title', 'Detail Data Lookups')

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
    width: 35%;
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
            <h4 class="mb-0"><i class="fas fa-database"></i> Detail Lookup</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Informasi Utama -->
                <div class="col-md-6 mb-4">
                    <h5 class="mb-3"><i class="fas fa-id-card"></i> Informasi Utama</h5>
                    <table class="table-detail">
                        @php
                        $utama = [
                        'Main' => $items_lookups->bkl_main,
                        'Sub' => $items_lookups->bkl_sub ?? '-',
                        'Kategori' => $items_lookups->bkl_kategori,
                        'Nilai' => $items_lookups->bkl_nilai,
                        'Catatan' => $items_lookups->bkl_catatan ?? '-',
                        ];
                        @endphp
                        @foreach($utama as $label => $value)
                        <tr>
                            <td class="label">{{ $label }}</td>
                            <td class="separator">:</td>
                            <td>{{ $value }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <!-- Informasi Tambahan -->
                <div class="col-md-6 mb-4">
                    <h5 class="mb-3"><i class="fas fa-info-circle"></i> Informasi Tambahan</h5>
                    <table class="table-detail">
                        @php
                        $tambahan = [
                        'Status' => $items_lookups->bkl_status == 'A' ? 'Aktif' : 'Tidak Aktif',
                        'Dibuat Oleh' => $items_lookups->created_by,
                        'Diperbarui Oleh' => $items_lookups->updated_by ?? '-',
                        'Dibuat Pada' => $items_lookups->created_at->format('d-m-Y H:i'),
                        'Diperbarui Pada' => $items_lookups->updated_at->format('d-m-Y H:i'),
                        ];
                        @endphp
                        @foreach($tambahan as $label => $value)
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