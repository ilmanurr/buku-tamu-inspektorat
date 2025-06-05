<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lookups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController
{
    // Menampilkan daftar seluruh user
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    // Menampilkan halaman form tambah user baru
    public function create()
    {
        $roles = Lookups::where('bkl_main', 'role_user')->get();
        return view('users.create', compact('roles'));
    }

    // Menyimpan data user baru ke database
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:buku_tamu_lookups,id',
        ]);

        // Simpan data user baru ke database
        User::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Menampilkan halaman edit user
    public function edit(User $user)
    {
        $roles = Lookups::where('bkl_main', 'role_user')->get();
        return view('users.edit', compact('user', 'roles'));
    }

    // Memperbarui data user berdasarkan ID
    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:buku_tamu_lookups,id',
        ]);

        // Update user dengan password baru jika diinginkan
        $user->update([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Menghapus data user dari database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    // Menampilkan halaman edit profil untuk user yang sedang login
    public function editProfile()
    {
        $user = Auth::user();
        return view('users.edit-profile', compact('user'));
    }

    // Memperbarui profil user yang sedang login
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi dari input form edit profil
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);    

        // Update data profil
        $user->update([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

}