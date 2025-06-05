<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles) 
    {
        // Memeriksa apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Mendapatkan user yang sedang login
        $user = Auth::user();
        
        // Ambil role user dari tabel lookups berdasarkan role_id
        $userRole = strtolower(DB::table('buku_tamu_lookups')
        ->where('id', $user->role_id)
        ->value('bkl_kategori')); 

        // Ubah semua role dari parameter menjadi lowercase untuk perbandingan case-insensitive
        $roles = array_map('strtolower', $roles); 

        // Jika role user tidak ada dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}