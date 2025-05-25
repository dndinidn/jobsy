<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AuthController;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kategori',
        
    ];
    public function lowongans()
{
    return $this->belongsToMany(Lowongan::class, 'category_lowongan', 'kategori_id', 'lowongan_id');
}
    //
}
