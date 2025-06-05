<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lookups extends Model
{
    use HasFactory;

    protected $table = 'buku_tamu_lookups';

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'bkl_main',
        'bkl_sub',
        'bkl_kategori',
        'bkl_nilai',
        'bkl_catatan',
        'bkl_status',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];
}