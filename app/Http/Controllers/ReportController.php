<?php
namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\View;

class ReportController
{
    // Menampilkan halaman laporan data buku tamu berdasarkan tanggal dan filter status kartu.
    public function index(Request $request)
    {
        // Ambil input tanggal dari request atau gunakan tanggal hari ini sebagai default
        $tanggalMulai = $request->tanggal_mulai ?? Carbon::today()->toDateString();
        $tanggalSelesai = $request->tanggal_selesai ?? Carbon::today()->toDateString();
        $filterStatus = $request->filter_status_kartu ?? 'semua_tamu';

        // Query data buku tamu berdasarkan rentang tanggal kunjungan
        $query = BukuTamu::whereBetween('bkd_tanggal_kunjungan', [$tanggalMulai, $tanggalSelesai]);

        // Jika filter status 'belum_kembali', hanya ambil data yang menggunakan kartu dan belum kembali
        if ($filterStatus === 'belum_kembali') {
            $query->whereNotNull('bkd_kartu_akses_nama')->where('bkd_status', 'O');
        }

        // Ambil data dan urutkan berdasarkan tanggal kunjungan
        $reports = $query->orderBy('bkd_tanggal_kunjungan')->get();

        return view('report.index', compact(
            'reports', 'tanggalMulai', 'tanggalSelesai', 
            'filterStatus'
        ));
    }

    // Meng-generate laporan dalam format PDF berdasarkan filter dan rentang tanggal.
    public function print(Request $request)
    {
        App::setLocale('id');

        $tanggalMulai = $request->tanggal_mulai ?? Carbon::today()->toDateString();
        $tanggalSelesai = $request->tanggal_selesai ?? Carbon::today()->toDateString();
        $filterStatus = $request->filter_status_kartu ?? 'semua_tamu';

        $query = BukuTamu::whereBetween('bkd_tanggal_kunjungan', [$tanggalMulai, $tanggalSelesai]);

        if ($filterStatus === 'belum_kembali') {
            $query->whereNotNull('bkd_kartu_akses_nama')->where('bkd_status', 'O');
        }

        $reports = $query->orderBy('bkd_tanggal_kunjungan')->get();

        $tanggalMulaiFormat = Carbon::parse($tanggalMulai)->translatedFormat('d F Y');
        $tanggalSelesaiFormat = Carbon::parse($tanggalSelesai)->translatedFormat('d F Y');

        // Render HTML dari view untuk digunakan sebagai isi PDF
        $html = View::make('report.pdf', compact(
            'reports',
            'tanggalMulai',
            'tanggalSelesai',
            'tanggalMulaiFormat',
            'tanggalSelesaiFormat',
            'filterStatus'
        ))->render();

        // Debugging: memastikan HTML tidak kosong
        if (empty($html)) {
            return response()->json(['error' => 'Generated HTML is empty'], 500);
        }

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('isFontSubsettingEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        // Menambahkan nomor halaman
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(520, 800, "{PAGE_NUM}/{PAGE_COUNT}", null, 12, array(0, 0, 0));

        // Format dari tanggal sekian sampai sekian
        if ($tanggalMulai === $tanggalSelesai) {
            $namaFile = "Laporan Buku Tamu ({$tanggalMulaiFormat}).pdf";
        } else {
            $namaFile = "Laporan Buku Tamu ({$tanggalMulaiFormat} - {$tanggalSelesaiFormat}).pdf";
        }

        // Mengalirkan PDF menggunakan Laravel response
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $namaFile . '"');
        }

}