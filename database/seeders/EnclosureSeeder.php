<?php

namespace Database\Seeders;

use App\Models\Enclosure;
use Illuminate\Database\Seeder;

class EnclosureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создаем вольеры разных типов
        $types = ['forest', 'water', 'desert', 'savanna'];

        foreach ($types as $type) {
            // Создаем 2-3 вольера каждого типа
            $count = rand(2, 3);
            for ($i = 0; $i < $count; $i++) {
                Enclosure::factory()->create([
                    'type' => $type,
                    'is_open' => true,
                    'is_locked' => false,
                    'has_roof' => $type === 'forest', // Только лесные вольеры с крышей
                    'food_type' => $this->getFoodTypeForEnclosure($type),
                    'food_amount' => rand(100, 500),
                ]);
            }
        }
    }

    /**
     * Получить тип еды для вольера в зависимости от его типа
     */
    private function getFoodTypeForEnclosure(string $type): string
    {
        switch ($type) {
            case 'forest':
                return 'meat';
            case 'water':
                return 'fish';
            case 'desert':
                return 'insects';
            case 'savanna':
                return 'grass';
            default:
                return 'meat';
        }
    }
}
