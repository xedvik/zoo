<?php

namespace App\Animals\Mammals;

use App\Animals\Enums\DietType;

class Wolf extends AbstractMammal
{

    /**
     * Волк - хищник
     */
    public function getDietType(): string
    {
        return DietType::CARNIVORE;
    }



    /**
     * Расчет количества пищи для волка
     */
    public function calculateFoodAmount(): int
    {
        return 20; // Волк потребляет много пищи
    }
}
