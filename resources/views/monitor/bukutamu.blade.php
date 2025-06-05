@extends('layouts.app')

@section('title', 'Tabel Buku Tamu')

@section('content')

<style>
.btn-filter {
    margin-right: 8px;
}
</style>

<div class="container-fluid">
    <h2 class="mb-4">Daftar Buku Tamu</h2>

    <!-- Form filter berdasarkan rentang tanggal -->
    <form method="GET" action="{{ route('monitor.bukutamu') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="tanggal_mulai">Dari Tanggal:</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                    value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-md-4">
                <label for="tanggal_selesai">Sampai Tanggal:</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control"
                    value="{{ request('tanggal_selesai') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary btn-filter">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </div>
    </form>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="bukuTamuTable" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No Tamu</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Instansi</th>
                            <th>Keperluan</th>
                            <th>Nama Kartu Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukuTamu as $tamu)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $tamu->bkd_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($tamu->bkd_tanggal_kunjungan)->format('d-m-Y') }} </td>
                            <td>{{ $tamu->bkd_nama }}</td>
                            <td>{{ $tamu->bkd_jenis_kelamin }}</td>
                            <td>{{ $tamu->bkd_instansi }}</td>
                            <td>{{ $tamu->bkd_keperluan }}</td>
                            <td>{{ $tamu->bkd_kartu_akses_nama }}<br>
                                @if($tamu->bkd_status == 'O')
                                <span class="badge bg-warning text-light">Belum Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DataTables Script -->
@push('scripts')
<script>
$(document).ready(function() {
    $('#bukuTamuTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

    // Event listener ketika filter tanggal diubah
    $('#tanggal_mulai, #tanggal_selesai').on('change', function() {
        const tanggalMulai = $('#tanggal_mulai').val();
        const tanggalSelesai = $('#tanggal_selesai').val();

        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search);

        // Update parameter URL untuk tanggal mulai
        if (tanggalMulai) params.set('tanggal_mulai', tanggalMulai);
        else params.delete('tanggal_mulai');

        // Update parameter URL untuk tanggal selesai
        if (tanggalSelesai) params.set('tanggal_selesai', tanggalSelesai);
        else params.delete('tanggal_selesai');

        // Redirect ke URL baru dengan parameter filter
        window.location.href = `${url.pathname}?${params.toString()}`;
    });
});
</script>
@endpush

@endsection