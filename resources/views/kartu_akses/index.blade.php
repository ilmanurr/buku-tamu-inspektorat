@extends('layouts.app')

@section('title', 'Data Kartu Akses')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Data Kartu Akses</h2>

    <!-- Menampilkan pesan success -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kartu_akses.return') }}" class="btn btn-primary mb-3"> Kembalikan Kartu Akses</a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="kartuAksesTable" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>ID Kartu Akses</th>
                            <th>Nama Kartu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items_lookups as $index => $lookup)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lookup->bkl_kategori }}</td>
                            <td>{{ $lookup->bkl_nilai }}</td>
                            <td>
                                @if ($lookup->bkl_status === 'X')
                                <span class="badge bg-danger text-light">Tidak Aktif</span>
                                @elseif ($lookup->status_kartu === 'O')
                                <span class="badge bg-warning text-light">Sedang Dipakai</span>
                                @else
                                <span class="badge bg-success text-light">Tersedia</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data kartu akses.</td>
                        </tr>
                        @endforelse
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
    $('#kartuAksesTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});
</script>
@endpush

@endsection