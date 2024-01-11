<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Kategori;

class Keluar extends Model
{
    use HasFactory;
    protected $table = 'keluar';
    public $primaryKey = 'idkeluar';

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class,'idkategori','idkategori');
    }
}