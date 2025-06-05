@extends('layouts.app')

@section('title', 'Form Edit Data Tamu')

@section('content')

<style>
.ui-autocomplete {
    background-color: white;
    border: 1px solid #ccc;
    max-height: 200px;
    overflow-y: auto;
    z-index: 1050;
    box-sizing: border-box;
    position: absolute;
}

.ui-menu {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.ui-menu-item {
    padding: 8px 12px;
    cursor: pointer;
}

.ui-menu-item:hover {
    background-color: #f0f0f0;
}

.stats {
    display: flex;
    gap: 10px;
    margin-top: 25px;
    margin-bottom: 25px;
}

.stat-box {
    background: rgb(220, 227, 241);
    padding: 10px;
    border-radius: 12px;
    text-align: center;
    flex: 1;
    font-size: 14px;
    font-weight: bold;
    color: #002244;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-width: 120px;
    height: auto;
}

.stat-box h2 {
    font-size: 20px;
    margin: 2px 0;
    font-weight: 700;
}

.stat-box p {
    font-size: 16px;
    margin: 2px 0;
    font-weight: 500;
}

.stat-box .icon {
    font-size: 24px;
    margin-bottom: 2px;
}

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
    <H2>Ubah Data Tamu</H2>

    <!-- Menampilkan pesan error -->
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow p-4">
        <form action="{{ route('bukutamu.update', $bukuTamu->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="bkd_identitas">No. Identitas</label>
                    <input type="text" name="bkd_identitas" id="bkd_identitas" class="form-control"
                        value="{{ $bukuTamu->bkd_identitas }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="bkd_nama">Nama</label>
                    <input type="text" name="bkd_nama" id="bkd_nama" class="form-control"
                        value="{{ $bukuTamu->bkd_nama }}">
                </div>
            </div>

            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="bkd_jenis_kelamin">Jenis Kelamin</label>
                    <select name="bkd_jenis_kelamin" id="bkd_jenis_kelamin" class="form-control" required>
                        <option value="" disabled>Pilih Jenis Kelamin</option>
                        <option value="L" {{ $bukuTamu->bkd_jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki
                        </option>
                        <option value="P" {{ $bukuTamu->bkd_jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="bkd_telepon">Telepon</label>
                    <input type="text" name="bkd_telepon" id="bkd_telepon" class="form-control"
                        value="{{ $bukuTamu->bkd_telepon }}">
                </div>
            </div>

            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="instansi-search">Instansi</label>
                    <input type="text" id="instansi-search" name="bkd_instansi" class="form-control"
                        value="{{ $bukuTamu->bkd_instansi }}">
                    <small id="instansi-not-found" class="text-danger" style="display: none;">Instansi tidak ditemukan.
                        Silakan isi provinsi/kota dan kategori instansi.</small>

                    <!-- Field tambah instansi baru jika instansi yang diinput belum ada di list instansi -->
                    <div id="new-instansi-fields" style="display: none; margin-top: 1rem;">
                        <div class="form-group" style="margin-bottom: 0.5rem;">
                            <label class="form-label" for="bkl_sub">Provinsi/Kota Instansi</label>
                            <input type="text" name="bkl_sub" id="bkl_sub" class="form-control"
                                placeholder="Wajib diisi jika menambahkan instansi baru">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="bkl_kategori">Kategori Instansi</label>
                            <input type="text" name="bkl_kategori" id="bkl_kategori" class="form-control"
                                placeholder="Wajib diisi jika menambahkan instansi baru">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="keperluan-search">Keperluan</label>
                    <input type="text" id="keperluan-search" name="bkd_keperluan" class="form-control"
                        placeholder="Cari keperluan..." value="{{ $bukuTamu->bkd_keperluan }}">
                </div>
            </div>

            <div class="flex-row-form">
                <div class="form-group">
                    <label class="form-label" for="bkd_rombongan">Jumlah Rombongan</label>
                    <input type="number" name="bkd_rombongan" id="bkd_rombongan" class="form-control"
                        value="{{ $bukuTamu->bkd_rombongan }}">
                </div>

                <div class="form-group" style="display: flex; gap: 15px;">
                    <div style="flex: 5;">
                        <label class="form-label" for="kartuakses-search">Nama Kartu Akses</label>
                        <input type="text" id="kartuakses-search" name="bkd_kartu_akses_nama" class="form-control"
                            placeholder="Cari kartu akses..." value="{{ $bukuTamu->bkd_kartu_akses_nama }}">
                    </div>

                    <div style="flex: 5;">
                        <label class="form-label" for="bkd_status">Status Kartu Akses</label>
                        <select name="bkd_status" id="bkd_status" class="form-control">
                            <option value="O" {{ $bukuTamu->bkd_status == 'O' ? 'selected' : '' }}>Sedang Dipakai
                            </option>
                            <option value="P" {{ $bukuTamu->bkd_status == 'P' ? 'selected' : '' }}>Sudah Dikembalikan
                            </option>
                        </select>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
        </form>
    </div>

    <div class="mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Pencarian Instansi
    $("#instansi-search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('bukutamu.searchInstansi') }}",
                data: {
                    q: request.term,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 0,
        select: function(event, ui) {
            $("#instansi-search").val(ui.item.value);
            return false;
        },
        focus: function(event, ui) {
            $("#instansi-search").val(ui.item.value);
            return false;
        },
        open: function() {
            const inputWidth = $('#instansi-search').outerWidth();
            $('.ui-autocomplete').css('width', inputWidth + 'px');
        }
    });

    // Pencarian keperluan
    $("#keperluan-search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('bukutamu.searchKeperluan') }}",
                data: {
                    q: request.term,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 0,
        select: function(event, ui) {
            $("#keperluan-search").val(ui.item.value);
            return false;
        },
        focus: function(event, ui) {
            $("#keperluan-search").val(ui.item.value);
            return false;
        },
        open: function() {
            const inputWidth = $('#keperluan-search').outerWidth();
            $('.ui-autocomplete').css('width', inputWidth + 'px');
        }
    });

    // Pencarian kartu akses
    $("#kartuakses-search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{{ route('bukutamu.searchKartuAkses') }}",
                data: {
                    kartuakses: request.term,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 0,
        select: function(event, ui) {
            $("#kartuakses-search").val(ui.item.value);
            return false;
        },
        focus: function(event, ui) {
            $("#kartuakses-search").val(ui.item.value);
            return false;
        },
        open: function() {
            const inputWidth = $('#kartuakses-search').outerWidth();
            $('.ui-autocomplete').css('width', inputWidth + 'px');
        }
    });

    // Trigger field instansi
    $("#instansi-search").on('click', function() {
        $(this).autocomplete("search", "");
    });

    // Trigger field keperluan
    $("#keperluan-search").on('click', function() {
        $(this).autocomplete("search", "");
    });

    // Trigger field kartu akses
    $("#kartuakses-search").on('click', function() {
        $(this).autocomplete("search", "");
    });

});
</script>
@endpush

@endsection