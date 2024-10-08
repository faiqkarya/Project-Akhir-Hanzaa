<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returning extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'tanggal_dikembalikan',
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
