<?php

namespace App\Animals\Mammals;

use App\Animals\Enums\DietType;

/**
 * Класс газели
 */
class Gazelle extends AbstractMammal
{
    /**
     * Газель - травоядное животное
     */
    public function getDietType(): string
    {
        return DietType::HERBIVORE;
    }

    /**
     * Расчет количества пищи для газели
     */
    public function calculateFoodAmount(): int
    {
        return 12; // Газель потребляет меньше пищи, чем другие млекопитающие
    }
}
