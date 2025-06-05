@extends('layouts.app')

@section('title', 'Monitor Lookups')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">Daftar Lookups</h2>

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