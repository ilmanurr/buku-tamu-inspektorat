@extends('layouts.app')

@section('title', 'Tabel Lookups')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">Daftar Lookups</h2>

    <!-- Menampilkan pesan success -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3" style="width: 200px;">
        <div class="dropdown w-100">
            <button class="btn btn-primary dropdown-toggle w-100" type="button" id="dropdownTambahLookup"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-plus"></i> Tambah Lookup
            </button>
            <div class="dropdown-menu w-100" aria-labelledby="dropdownTambahLookup">
                <a class="dropdown-item" href="{{ route('lookups.create', ['tipe' => 'instansi']) }}">Instansi</a>
                <a class="dropdown-item" href="{{ route('lookups.create', ['tipe' => 'keperluan']) }}">Keperluan</a>
                <a class="dropdown-item" href="{{ route('lookups.create', ['tipe' => 'kartu_akses']) }}">Kartu Akses</a>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="lookupTable" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Main</th>
                            <th>Sub</th>
                            <th>Kategori</th>
                            <th>Nilai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items_lookups as $item_lookup)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item_lookup->bkl_main }}</td>
                            <td>{{ $item_lookup->bkl_sub }}</td>
                            <td>{{ $item_lookup->bkl_kategori }}</td>
                            <td>{{ $item_lookup->bkl_nilai }}</td>
                            <td>{{ $item_lookup->bkl_status }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('lookups.show', $item_lookup->id) }}"
                                        class="btn btn-secondary btn-sm" style="margin-right: 4px;">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('lookups.edit', $item_lookup->id) }}"
                                        class="btn btn-warning btn-sm" style="margin-right: 4px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('lookups.destroy', $item_lookup->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
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
$(document).ready(function() {
    $('#lookupTable').DataTable({
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