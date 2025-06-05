<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    use HasFactory;

    protected $table = 'buku_tamu_datas';

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'bkd_no',
        'bkd_tanggal_kunjungan',
        'bkd_jam_kunjungan',
        'bkd_identitas',
        'bkd_nama',
        'bkd_jenis_kelamin',
        'bkd_telepon',
        'bkd_instansi',
        'bkd_keperluan',
        'bkd_rombongan',
        'bkd_kartu_akses_id',
        'bkd_kartu_akses_nama',
        'bkd_status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}