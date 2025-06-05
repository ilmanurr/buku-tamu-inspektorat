<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTamu;
use App\Models\Lookups;

class MonitorController
{
    // Menampilkan daftar data buku tamu yang bisa difilter berdasarkan rentang tanggal
    public function bukuTamu(Request $request)
    {
        $query = BukuTamu::query();

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('bkd_tanggal_kunjungan', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        $bukuTamu = $query->orderBy('bkd_tanggal_kunjungan', 'desc')
                      ->orderBy('bkd_jam_kunjungan', 'desc')
                      ->get();

        return view('monitor.bukutamu', compact('bukuTamu'));
    }

    // Menampilkan daftar data lookups
    public function lookups()
    {
        $items_lookups = Lookups::orderBy('created_at', 'asc')->get();

        return view('monitor.lookups', compact('items_lookups'));
    }
}