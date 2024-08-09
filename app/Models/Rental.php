<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode',
        'user_id',
        'item_id',
        'customer_id',
        'tanggal_penyewaan',
        'tanggal_pengembalian',
        'status_id',
    ];

    public function return() {
        return $this->hasMany(Returning::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
