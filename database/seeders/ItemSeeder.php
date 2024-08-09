<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \App\Models\Item::factory()->create([
            'category_id' => Categories::where('category_name', 'Pakaian')->first('id'),
            'nama_barang' => 'Celana Jeans',
            'harga' => 70000,
            'harga_denda' => 30000,
            'deskripsi' => 'Celana Jeans ukuran 32 warna Hitam',
            'stok' => '15',
        ]);
        
        \App\Models\Item::factory()->create([
            'category_id' => Categories::where('category_name', 'Pakaian')->first('id'),
            'nama_barang' => 'Kemeja Lengan Panjang',
            'harga' => 70000,
            'harga_denda' => 30000,
            'deskripsi' => 'Kemeja Lengan Panjang Ukuran L warna Putih',
            'stok' => '10',
        ]);
        
        \App\Models\Item::factory()->create([
            'category_id' => Categories::where('category_name', 'Kamera')->first('id'),
            'nama_barang' => 'Canon EOS R5',
            'harga' => 150000,
            'harga_denda' => 50000,
            'deskripsi' => 'Kamera mirrorless full-frame yang menawarkan resolusi 45 megapiksel, kemampuan video 8K, dan sistem autofokus yang sangat canggih. Cocok untuk fotografer profesional yang membutuhkan kualitas gambar tinggi dan kinerja cepat.',
            'stok' => '10',
        ]);
        
        \App\Models\Item::factory()->create([
            'category_id' => Categories::where('category_name', 'Kamera')->first('id'),
            'nama_barang' => 'Nikon Z6 II',
            'harga' => 200000,
            'harga_denda' => 70000,
            'deskripsi' => 'Kamera mirrorless full-frame dengan sensor 24.5 megapiksel. Menawarkan video 4K, dual card slots, dan kinerja autofokus yang ditingkatkan. Cocok untuk berbagai jenis fotografi termasuk potret, lanskap, dan aksi cepat.',
            'stok' => '12',
        ]);
        
        \App\Models\Item::factory()->create([
            'category_id' => Categories::where('category_name', 'Sepatu')->first('id'),
            'nama_barang' => 'Nike Air Force 1',
            'harga' => 100000,
            'harga_denda' => 25000,
            'deskripsi' => 'Sepatu ini pertama kali diperkenalkan pada tahun 1982 dan menjadi ikon dalam dunia sneaker. Dikenal karena desainnya yang sederhana namun elegan, serta kenyamanannya yang tinggi. Cocok untuk berbagai aktivitas sehari-hari.',
            'stok' => '12',
        ]);
    }
}
