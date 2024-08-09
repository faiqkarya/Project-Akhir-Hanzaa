<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::create([
            'category_name' => 'Pakaian',
        ]);
        
        Categories::create([
            'category_name' => 'Kamera',
        ]);
        
        Categories::create([
            'category_name' => 'Sepatu',
        ]);
    }
}
