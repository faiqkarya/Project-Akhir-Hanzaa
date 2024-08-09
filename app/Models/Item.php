<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'nama_barang',
        'harga',
        'harga_denda',
        'deskripsi',
        'gambar',
        'stok',
    ];

    public function rentals() {
        return $this->hasMany(Rental::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
}
