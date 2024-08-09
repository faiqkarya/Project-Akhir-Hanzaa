<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan',
        'no_ktp',
        'alamat',
    ];

    public function customer() {
        return $this->hasMany(Customer::class);
    }
}
