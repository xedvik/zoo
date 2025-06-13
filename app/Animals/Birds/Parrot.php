<?php

namespace App\Animals\Birds;

use App\Animals\Enums\DietType;

class Parrot extends AbstractBird
{
    /**
     * Попугай - травоядное животное
     */
    public function getDietType(): string
    {
        return DietType::HERBIVORE;
    }



    /**
     * Расчет количества пищи для попугая
     */
    public function calculateFoodAmount(): int
    {
        return 8; // Попугай потребляет мало пищи
    }
}
