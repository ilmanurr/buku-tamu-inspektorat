@extends('layouts.app')

@section('title', 'Pengembalian Kartu Akses')

@section('content')
<div class="container">
    <div class="card shadow p-4">
        <h4 class="mb-1">Pengembalian Kartu Akses</h4>
        <small class="text-muted d-block mb-4"><em>Cukup input/pilih salah satu antara ID atau nama kartu
                akses</em></small>

        <!-- Menampilkan pesan success -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Menampilkan pesan error -->
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('kartu_akses.submit') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kartu_akses_id" class="form-label">ID Kartu Akses</label>
                        <input type="text" name="kartu_akses_id" id="kartu_akses_id" class="form-control"
                            placeholder="Masukkan ID kartu akses jika perlu">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="kartu_akses_nama" class="form-label">Nama Kartu Akses</label>
                        <select name="kartu_akses_nama" id="kartu_akses_nama" class="form-control">
                            <option value="">Pilih Kartu Akses</option>
                            @foreach($kartuAksesDigunakan as $nama_kartu_akses)
                            <option value="{{ $nama_kartu_akses }}">{{ $nama_kartu_akses }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
        </form>
    </div>

    <div class="mt-4">
        <a href="{{ route('kartu_akses.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<!-- Script tambahan untuk autofocus dan submit otomatis ketika enter -->
@push('scripts')
<script>
// Fokus otomatis ke field input ID kartu akses saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const inputField = document.getElementById('kartu_akses_id');
    inputField.focus();

    // Jika user menekan Enter di kolom input, langsung submit form
    inputField.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            inputField.form.submit();
        }
    });
});
</script>
@endpush
@endsection