@extends('layouts.app')

@section('title', 'Form Edit Data Lookups')

@section('content')

<style>
.flex-row-form {
    display: flex;
    flex-wrap: wrap;
    gap: 25px;
}

.flex-row-form .form-group {
    flex: 1 1 48%;
}

@media (max-width: 768px) {
    .flex-row-form {
        gap: 0;
    }

    .flex-row-form .form-group {
        flex: 1 1 100%;
    }
}
</style>

<div class="container">
    <H2>Ubah Data Lookup</H2>

    <!-- Menampilkan pesan error -->
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow p-4">
        <form action="{{ route('lookups.update', $items_lookups->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="bkl_main">Main</label>
                    <input type="text" id="bkl_main" name="bkl_main" class="form-control"
                        value="{{ $items_lookups->bkl_main }}" required readonly>
                </div>

                <div class="form-group">
                    <label class="form-label" for="bkl_sub">Sub</label>
                    <input type="text" id="bkl_sub" name="bkl_sub" class="form-control"
                        value="{{ $items_lookups->bkl_sub }}" required readonly>
                </div>
            </div>

            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="bkl_kategori">Kategori</label>
                    <input type="text" id="bkl_kategori" name="bkl_kategori" class="form-control"
                        value="{{ $items_lookups->bkl_kategori }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="bkl_nilai">Nilai</label>
                    <input type="text" id="bkl_nilai" name="bkl_nilai" class="form-control"
                        value="{{ $items_lookups->bkl_nilai }}">
                </div>
            </div>

            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="bkl_catatan">Catatan</label>
                    <input type="text" id="bkl_catatan" name="bkl_catatan" class="form-control"
                        value="{{ $items_lookups->bkl_catatan }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="bkl_status">Status</label>
                    <select id="bkl_status" name="bkl_status" class="form-control" required>
                        <option value="A" {{ $items_lookups->bkl_status == 'A' ? 'selected' : '' }}>Aktif</option>
                        <option value="X" {{ $items_lookups->bkl_status == 'X' ? 'selected' : '' }}>Tidak Aktif
                        </option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
        </form>
    </div>

    <div class="mt-4">
        <a href="{{ route('lookups.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection