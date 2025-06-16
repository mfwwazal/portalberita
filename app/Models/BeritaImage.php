<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaImage extends Model
{
    use HasFactory;

    protected $fillable = ['beritas_id', 'path'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}