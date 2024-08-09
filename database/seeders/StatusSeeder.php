<?php

namespace Database\Seeders;

use App\Models\Status;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'status_name' => 'Dikembalikan',
        ]);
        
        Status::create([
            'status_name' => 'Disewa',
        ]);
        
        Status::create([
            'status_name' => 'Dibatalkan',
        ]);
    }
}
