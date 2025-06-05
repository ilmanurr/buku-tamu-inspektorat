@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')

<div class="container-fluid">
    <h2 class="mb-4">Daftar User</h2>

    <!-- Menampilkan pesan success -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah User
    </a>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="userTable" class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nama_user }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->bkl_nilai ?? '-' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm me-1"
                                        style="margin-right: 4px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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

@push('scripts')
<!-- DataTables Script -->
<script>
$(document).ready(function() {
    $('#userTable').DataTable({
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