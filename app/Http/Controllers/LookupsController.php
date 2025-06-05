<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;
use App\Models\Lookups;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LookupsController
{
    // Menampilkan daftar lookup
    public function index()
    {
        $items_lookups = Lookups::all(); 
        return view('lookups.index', compact('items_lookups'));
    }

    // Menampilkan form untuk membuat data lookup baru dengan memilih salah satu tipe (instansi, keperluan, dan kartu akses)
    public function create(Request $request)
    {
        $tipe = $request->query('tipe');

        $prefill = [
            'main' => '',
            'sub' => '',
            'kategori' => ''
        ];

        // Menyesuaikan prefill berdasarkan tipe
        if ($tipe === 'instansi') {
            $prefill['main'] = 'instansi';
        } elseif ($tipe === 'keperluan') {
            $prefill['main'] = 'keperluan';
            $prefill['sub'] = 'keperluan';
            $prefill['kategori'] = 'keperluan';
        } elseif ($tipe === 'kartu_akses') {
            $prefill['main'] = 'kartu_akses';
            $prefill['sub'] = 'kartu_akses';
        }

        return view('lookups.create', compact('prefill'));
    }

    // Menyimpan data lookup baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'bkl_main' => 'required|string|max:255',
            'bkl_sub' => 'nullable|string|max:255',
            'bkl_kategori' => 'required|string|max:255',
            'bkl_nilai' => 'required|string|max:255',
            'bkl_catatan' => 'nullable|string', 
            'bkl_status' => 'required|in:A,X',
        ]);
        
        // Menyimpan data lookup ke dalam database
        Lookups::create([
            'bkl_main' => $request->bkl_main,
            'bkl_sub' => $request->bkl_sub,
            'bkl_kategori' => $request->bkl_kategori,
            'bkl_nilai' => $request->bkl_nilai,
            'bkl_catatan' => $request->bkl_catatan ?? '', 
            'bkl_status' => $request->bkl_status ?? 'A',
            'created_by' => Auth::id() . ' | ' . Auth::user()->nama_user,
            'updated_by' => Auth::id() . ' | ' . Auth::user()->nama_user,
        ]);
        
        return redirect()->route('lookups.index')->with('success', 'Lookup berhasil ditambahkan!');
    }

    // Menampilkan detail data lookup berdasarkan ID yang dipilih
    public function show($id)
    {
        $items_lookups = Lookups::findOrFail($id);
        return view('lookups.show', compact('items_lookups'));
    }

    // Menampilkan form edit berdasarkan ID lookup yang dipilih
    public function edit($id)
    {
        $items_lookups = Lookups::findOrFail($id);
        return view('lookups.edit', compact('items_lookups'));
    }

    // Memperbarui data lookup
    public function update(Request $request, $id)
    {
        $items_lookups = Lookups::findOrFail($id);

        // Validasi data input
        $request->validate([
            'bkl_main' => 'required|string|max:255',
            'bkl_sub' => 'nullable|string|max:255',
            'bkl_kategori' => 'required|string|max:255',
            'bkl_nilai' => 'required|string|max:255',
            'bkl_catatan' => 'nullable|string',
            'bkl_status' => 'required|in:A,X',
        ]);

        // Menyimpan perubahan data lookup ke dalam database
        $items_lookups->update([
            'bkl_main' => $request->bkl_main,
            'bkl_sub' => $request->bkl_sub,
            'bkl_kategori' => $request->bkl_kategori,
            'bkl_nilai' => $request->bkl_nilai,
            'bkl_catatan' => $request->bkl_catatan ?? '', 
            'bkl_status' => $request->bkl_status,
            'updated_by' => Auth::id() . ' | ' . Auth::user()->nama_user,
        ]);

        return redirect()->route('lookups.index')->with('success', 'Lookup berhasil diperbarui!');
    }

    // Menghapus data lookup berdasarkan ID 
    public function destroy($id)
    {
        $items_lookups = Lookups::findOrFail($id);
        $items_lookups->delete();

        return redirect()->route('lookups.index')->with('success', 'Lookup berhasil dihapus!');
    }

    // Menampilkan semua daftar kartu akses
    public function indexKartuAkses()
    {
        // Mengambil daftar kartu akses yang sedang digunakan oleh tamu (bkd_status = O (Outstanding))
        $subquery = BukuTamu::select('bkd_kartu_akses_nama')
            ->where('bkd_status', 'O')
            ->groupBy('bkd_kartu_akses_nama');

        // Mengambil data lookup kartu akses dan mencocokkan dengan subquery apakah kartu akses sedang digunakan tamu
        $items_lookups = DB::table('buku_tamu_lookups as bkl')
            ->leftJoinSub($subquery, 'used_cards', function ($join) {
                $join->on('bkl.bkl_nilai', '=', 'used_cards.bkd_kartu_akses_nama');
            })
            ->select(
                'bkl.bkl_main',
                'bkl.bkl_kategori',
                'bkl.bkl_nilai',
                'bkl.bkl_status',
                DB::raw("CASE WHEN used_cards.bkd_kartu_akses_nama IS NOT NULL THEN 'O' ELSE NULL END as status_kartu")
            )
            ->where('bkl.bkl_main', 'kartu_akses')
            ->get();

        return view('kartu_akses.index', compact('items_lookups'));
    }
}