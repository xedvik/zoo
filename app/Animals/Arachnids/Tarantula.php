<?php

namespace App\Animals\Arachnids;

use App\Animals\Enums\DietType;

class Tarantula extends AbstractArachnid
{
    /**
     * Тарантул ядовит
     */
    public function isPoisonous(): bool
    {
        return true;
    }

    /**
     * Тарантул - хищник
     */
    public function getDietType(): string
    {
        return DietType::CARNIVORE;
    }


    /**
     * Расчет количества пищи для тарантула
     */
    public function calculateFoodAmount(): int
    {
        return 5; // Тарантул потребляет мало пищи
    }
}
