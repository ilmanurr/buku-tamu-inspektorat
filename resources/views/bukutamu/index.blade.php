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

    <!-- Menampilkan pesan success -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form filter berdasarkan rentang tanggal -->
    <form method="GET" action="{{ route('bukutamu.index') }}" class="mb-3">
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukuTamu as $tamu)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tamu->bkd_no }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($tamu->bkd_tanggal_kunjungan)->format('d-m-Y') }}<br>
                                {{ $tamu->bkd_jam_kunjungan }}
                            </td>
                            <td>{{ $tamu->bkd_nama }}</td>
                            <td>{{ $tamu->bkd_jenis_kelamin }}</td>
                            <td>{{ $tamu->bkd_instansi }}</td>
                            <td>{{ $tamu->bkd_keperluan }}</td>
                            <td class="text-center">{{ $tamu->bkd_kartu_akses_nama }}<br>
                                @if($tamu->bkd_status == 'O')
                                <span class="badge bg-warning text-light">Belum Dikembalikan</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('bukutamu.show', $tamu->id) }}"
                                        class="btn btn-secondary btn-sm me-1" style="margin-right: 4px;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('bukutamu.edit', $tamu->id) }}"
                                        class="btn btn-warning btn-sm me-1" style="margin-right: 4px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('bukutamu.destroy', $tamu->id) }}" method="POST"
                                        onsubmit="return confirmDelete('{{ $tamu->bkd_status }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
// Fungsi konfirmasi saat hapus data tamu
function confirmDelete(status) {
    if (status === 'O') {
        return confirm("Kartu belum dikembalikan. Yakin ingin menghapus data tamu ini?");
    } else {
        return confirm("Yakin ingin menghapus data tamu ini?");
    }
}

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