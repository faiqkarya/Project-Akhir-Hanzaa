<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'nama_pelanggan' => 'Rifky Yudha Pratama',
            'no_ktp' => '1116578930987456',
            'alamat' => 'Bukit Bintang',
        ]);
        
        Customer::create([
            'nama_pelanggan' => 'Sahli Kurniawan',
            'no_ktp' => '1116578930989034',
            'alamat' => 'Rantau Prapat',
        ]);

        Customer::create([
            'nama_pelanggan' => 'Musaed Hasanuddin',
            'no_ktp' => '1116578930987234',
            'alamat' => 'Krueng Mane',
        ]);
        
        Customer::create([
            'nama_pelanggan' => 'Al Ghazali',
            'no_ktp' => '1116578930909384',
            'alamat' => 'Jakarta Selatan',
        ]);
        
        Customer::create([
            'nama_pelanggan' => 'Dani Simajuntak',
            'no_ktp' => '1116578930909437',
            'alamat' => 'Medan',
        ]);
    }
}
