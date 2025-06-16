<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
  protected $table = 'lamarans'; // nama tabel, jika tidak standar

    protected $fillable = [
        'lowongan_id',
        'user_id',
        'nama',
        'telepon',
        'cv_path',
        'status',
        
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }
   // Model Lamaran.php
public function lowongan()
{
    return $this->belongsTo(Lowongan::class, 'lowongan_id');
}

}
