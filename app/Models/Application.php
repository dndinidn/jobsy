<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    // App\Models\Application.php

public function user()
{
    return $this->belongsTo(User::class);
}

public function lowongan()
{
    return $this->belongsTo(Lowongan::class);
}
}
