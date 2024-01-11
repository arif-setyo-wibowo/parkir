<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Kategori;

class Parkir extends Model
{
    use HasFactory;
    protected $table = 'parkir';
    public $primaryKey = 'idparkir';

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class,'idkategori','idkategori');
    }
}