<?php

namespace App\Models\Master;

use App\Models\Artikel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function artikel()
    {
        return $this->hasMany(Artikel::class);
    }
}
