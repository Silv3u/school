<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Catalog of selectable brands & models.
     */
    public function run(): void
    {
        $catalog = [
            'Toyota' => [
                ['model' => 'Supra', 'color' => '#e63946', 'speed_rating' => 5],
                ['model' => 'GR86', 'color' => '#1982c4', 'speed_rating' => 4],
                ['model' => 'Corolla', 'color' => '#8ac926', 'speed_rating' => 2],
            ],
            'Ford' => [
                ['model' => 'Mustang GT', 'color' => '#ff595e', 'speed_rating' => 5],
                ['model' => 'Focus RS', 'color' => '#1982c4', 'speed_rating' => 4],
                ['model' => 'Fiesta ST', 'color' => '#ffca3a', 'speed_rating' => 3],
            ],
            'Nissan' => [
                ['model' => 'GT-R', 'color' => '#457b9d', 'speed_rating' => 5],
                ['model' => 'Skyline R34', 'color' => '#1d3557', 'speed_rating' => 5],
                ['model' => '370Z', 'color' => '#f4a261', 'speed_rating' => 4],
            ],
            'BMW' => [
                ['model' => 'M3', 'color' => '#6a4c93', 'speed_rating' => 4],
                ['model' => 'M4', 'color' => '#264653', 'speed_rating' => 5],
                ['model' => 'X5', 'color' => '#52b788', 'speed_rating' => 3],
            ],
            'Volkswagen' => [
                ['model' => 'Golf GTI', 'color' => '#ff924c', 'speed_rating' => 3],
                ['model' => 'Golf R', 'color' => '#e63946', 'speed_rating' => 4],
                ['model' => 'Polo', 'color' => '#8ac926', 'speed_rating' => 2],
            ],
        ];

        foreach ($catalog as $brand => $models) {
            foreach ($models as $details) {
                Car::query()->updateOrCreate(
                    ['brand' => $brand, 'model' => $details['model']],
                    $details,
                );
            }
        }
    }
}
