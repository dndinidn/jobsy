<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    // Nama tabel (opsional, Laravel default pakai bentuk jamak dari nama model)
    protected $table = 'lowongans';

    // Kolom yang boleh diisi secara mass-assignment (fillable)
    protected $fillable = [
        'user_id',
        'title',
        'location',
        'employment_type',
        'description',
        'salary',
          'jumlah_orang',
        'posted_at',
    ];
    public function location()
{
    return $this->belongsTo(Region::class, 'location_id');
}
public function kategoris()
{
    return $this->belongsToMany(Kategori::class, 'category_lowongan', 'lowongan_id', 'kategori_id');
}
    // Relasi ke model User (pemilik lowongan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lamarans()
{
    return $this->hasMany(Lamaran::class);
}

}
