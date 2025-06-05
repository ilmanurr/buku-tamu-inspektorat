<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LookupsSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/buku_tamu_lookups.csv');

        if (!file_exists($file) || !is_readable($file)) {
            throw new \Exception("File CSV tidak ditemukan atau tidak bisa dibaca.");
        }

        $header = null;
        $data = [];

        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $record = array_combine($header, $row);

                    // Format tanggal
                    $record['created_at'] = $this->convertDateTime($record['created_at']);
                    $record['updated_at'] = $this->convertDateTime($record['updated_at']);

                    $data[] = $record;
                }
            }
            fclose($handle);
        }

        DB::table('buku_tamu_lookups')->insert($data);
    }

    private function convertDateTime($datetime)
    {
        try {
            return Carbon::createFromFormat('n/j/Y H:i', $datetime)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return now(); // fallback kalau gagal parse
        }
    }
}