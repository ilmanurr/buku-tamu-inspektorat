<?php

namespace App\Policies;

use App\Models\BukuTamu;
use App\Models\User;

class BukuTamuPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole(['super_admin', 'resepsionis', 'monitor']);
    }

    public function view(User $user, BukuTamu $bukuTamu)
    {
        return $user->hasRole(['super_admin', 'resepsionis', 'monitor']);
    }

    public function create(User $user)
    {
        return $user->hasRole(['super_admin', 'resepsionis']);
    }

    public function update(User $user, BukuTamu $bukuTamu)
    {
        return $user->hasRole(['super_admin', 'resepsionis']);
    }

    public function delete(User $user, BukuTamu $bukuTamu)
    {
        return $user->hasRole('super_admin');
    }
}