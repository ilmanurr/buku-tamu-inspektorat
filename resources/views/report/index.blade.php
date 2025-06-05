@extends('layouts.app')

@section('title', 'Laporan Kartu Akses Tamu')

@section('content')

<style>
.btn-filter {
    margin-right: 8px;
}
</style>

<div class="container-fluid">
    <h2 class="mb-4 d-print-none">Laporan Buku Tamu</h2>

    <!-- Form filter laporan berdasarkan tanggal dan status pengembalian kartu -->
    <form method="GET" action="{{ route('report.index') }}" class="mb-3 d-print-none">
        <div class="form-row d-flex align-items-end flex-wrap gap-2">
            <!-- Filter berdasarkan rentang tanggal -->
            <div class="col-auto">
                <label for="tanggal_mulai">Dari Tanggal:</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                    value="{{ request('tanggal_mulai', $tanggalMulai) }}">
            </div>
            <div class="col-auto">
                <label for="tanggal_selesai">Sampai Tanggal:</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
                    value="{{ request('tanggal_selesai', $tanggalSelesai) }}">
            </div>

            <!-- Filter berdasarkan status kartu akses -->
            <div class="col-auto">
                <label for="filter_status_kartu">Status:</label>
                <select class="form-control" name="filter_status_kartu" id="filter_status_kartu"
                    onchange="this.form.submit()">
                    <option value="semua_tamu" {{ $filterStatus === 'semua_tamu' || !$filterStatus ? 'selected' : '' }}>
                        Semua Tamu</option>
                    <option value="belum_kembali" {{ $filterStatus === 'belum_kembali' ? 'selected' : '' }}>Belum
                        Mengembalikan Kartu Akses</option>
                </select>
            </div>
            <div class="col-auto d-flex gap-1">
                <button type="submit" class="btn btn-primary btn-filter">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('report.print', ['tanggal_mulai' => request('tanggal_mulai'),'tanggal_selesai' => request('tanggal_selesai'),'filter_status_kartu' => request('filter_status_kartu'),]) }}"
                    target="_blank" class="btn btn-success">
                    <i class="fas fa-download"></i> Export
                </a>

            </div>
        </div>
    </form>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="reportTable" class="table table-bordered table-hover">
                    <thead class="thead-light text-center">
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
                            <td colspan="{{ $filterStatus === 'belum_kembali' ? 7 : 6 }}" class="text-center">
                                Tidak ada data tamu pada tanggal dan filter yang dipilih.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    let table = $('#reportTable');

    // Inisialisasi DataTable jika ada data (tidak hanya 1 baris colspan)
    if (table.find('tbody tr td').not('[colspan]').length > 0) {
        table.DataTable({
            "paging": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false
        });
    }

    // Mengatur filter tanggal dan status kartu akses secara otomatis
    $('#tanggal_mulai, #tanggal_selesai').on('change', function() {
        const tanggalMulai = $('#tanggal_mulai').val();
        const tanggalSelesai = $('#tanggal_selesai').val();
        const filterStatus = $('#filter_status_kartu').val();

        // Ambil URL saat ini
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);

        // Set parameter filter baru
        if (tanggalMulai) params.set('tanggal_mulai', tanggalMulai);
        else params.delete('tanggal_mulai');

        if (tanggalSelesai) params.set('tanggal_selesai', tanggalSelesai);
        else params.delete('tanggal_selesai');

        if (filterStatus) params.set('filter_status_kartu', filterStatus);

        // Redirect ke URL baru
        window.location.href = `${url.pathname}?${params.toString()}`;
    });

});
</script>
@endpush


@endsection