<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rental;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'kode' => $this->faker->regexify('[A-Z]{5}') . '-' . mt_rand(10000, 99999),
            'kode' =>  'RENT-' . mt_rand(10000, 99999),
            'tanggal_penyewaan' => Carbon::today()->subDays(3),
            'tanggal_pengembalian' => Carbon::today()->addDays(5)
        ];
    }
}
