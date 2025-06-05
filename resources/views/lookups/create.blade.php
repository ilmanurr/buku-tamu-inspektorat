@extends('layouts.app')

@section('title', 'Form Lookups')

@section('content')

@php
$tipe = request('tipe');
@endphp

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
    <H2>Tambah Lookup</H2>

    <!-- Menampilkan pesan error -->
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow p-4">
        <form action="{{ route('lookups.store') }}" method="POST">
            @csrf
            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="bkl_main">Main</label>
                    <input type="text" id="bkl_main" name="bkl_main" class="form-control"
                        value="{{ old('bkl_main', $prefill['main'] ?? '') }}" readonly required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="bkl_sub">Sub</label>
                    <input type="text" id="bkl_sub" name="bkl_sub" class="form-control"
                        value="{{ old('bkl_sub', $prefill['sub'] ?? '') }}"
                        placeholder="{{ $tipe == 'instansi' ? 'Provinsi / Kota Instansi' : '' }}"
                        @if(!empty($prefill['sub'])) readonly @endif required>
                </div>
            </div>

            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="bkl_kategori">Kategori @if($tipe == 'instansi')
                        <small class="text-danger" style="font-style: italic;">*Contoh: Dinas, Biro, UPT, dll</small>
                        @endif</label>
                    <input type="text" id="bkl_kategori" name="bkl_kategori" class="form-control"
                        value="{{ old('bkl_kategori', $prefill['kategori'] ?? '') }}"
                        placeholder="{{ $tipe == 'instansi' ? 'Kategori Instansi' : ($tipe == 'kartu_akses' ? 'ID Kartu Akses' : '') }}"
                        @if(!empty($prefill['kategori'])) readonly @endif>
                </div>
                <div class="form-group">
                    <label class="form-label" for="bkl_nilai">Nilai</label>
                    <input type="text" id="bkl_nilai" name="bkl_nilai" class="form-control"
                        placeholder="{{ $tipe == 'instansi' ? 'Nama Instansi' : ($tipe == 'keperluan' ? 'Jenis Keperluan' : ($tipe == 'kartu_akses' ? 'Nama Kartu Akses' : '')) }}">
                </div>
            </div>

            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="bkl_catatan">Catatan</label>
                    <input type="text" id="bkl_catatan" name="bkl_catatan" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label" for="bkl_status">Status</label>
                    <select id="bkl_status" name="bkl_status" class="form-control" required>
                        <option value="A" selected>Aktif</option>
                        <option value="X">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
        </form>
    </div>

    <div class="mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>

</div>

@endsection