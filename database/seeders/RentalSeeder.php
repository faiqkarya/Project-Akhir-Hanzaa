<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Rental::factory()->create([
            'user_id' => User::where('name', 'Hanza')->first('id'),
            'item_id' => Item::where('nama_barang', 'Kemeja Lengan Panjang')->first('id'),
            'customer_id' => Customer::where('nama_pelanggan', 'Rifky Yudha Pratama')->first('id'),
            'status_id' => Status::where('status_name', 'Disewa')->first('id'),
        ]);
    }
}
