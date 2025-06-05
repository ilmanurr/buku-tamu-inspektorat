<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
 
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id'; 

    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Lookups::class, 'role_id');
    }

    // Relasi dengan tabel buku_tamu_lookups untuk mendapatkan role user
    public function hasRole($roles)
    {
        if (!$this->role) {
            return false;
        }

        $userRole = $this->role->bkl_kategori; 

        if (is_array($roles)) {
            return in_array($userRole, $roles);
        }

        return $userRole === $roles;
    }


}