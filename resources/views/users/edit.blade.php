@extends('layouts.app')

@section('title', 'Edit Data User')

@section('content')

<div class="container">
    <h2>Ubah Data User</h2>
    <div class="card shadow p-4">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nama_user" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user"
                            value="{{ $user->nama_user }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                            autocomplete="email" required>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select class="form-control" id="role_id" name="role_id" required>
                            <option value="" disabled selected>Pilih Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->bkl_nilai }}
                            </option>
                            @endforeach
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

@endsection