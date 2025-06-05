@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')

<style>
.password-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #999;
}

.toggle-password:hover {
    color: #333;
}
</style>

<div class="container">
    <h2 class="mb-4">Edit Profil</h2>
    <div class="card shadow p-4">

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_user" class="form-label">Nama</label>
                <input type="text" name="nama_user" id="nama_user" class="form-control"
                    value="{{ old('nama_user', $user->nama_user) }}">
                @error('nama_user')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" autocomplete="email"
                    value="{{ old('email', $user->email) }}">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password <small class="text-danger"
                        style="font-style: italic;">*biarkan
                        kosong jika tidak ingin mengubah password</small></label>
                <div class="password-wrapper">
                    <input type="password" name="password" class="form-control" id="password">
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('password', this)"></i>
                </div>
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div id="konfirmasi-password-fields" class="mb-3" style="display: none;">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <div class="password-wrapper">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                    <i class="fas fa-eye toggle-password" onclick="togglePassword('password_confirmation', this)"></i>
                </div>
                @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
                @enderror
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
document.addEventListener("DOMContentLoaded", function() {
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordField = document.getElementById("konfirmasi-password-fields");

    // Menampilkan atau menyembunyikan field konfirmasi password berdasarkan input password
    function toggleConfirmPassword() {
        if (passwordInput.value.trim() !== "") {
            confirmPasswordField.style.display = "block";
        } else {
            confirmPasswordField.style.display = "none";
        }
    }

    toggleConfirmPassword();
    passwordInput.addEventListener("input", toggleConfirmPassword);
});

// Fungsi untuk menampilkan/sembunyikan input password
function togglePassword(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
@endpush

@endsection