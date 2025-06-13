<?php

namespace App\Animals\Mammals;

use App\Animals\Enums\DietType;

/**
 * Класс медведя
 */
class Bear extends AbstractMammal
{
    /**
     * Медведь всеяден
     */
    public function getDietType(): string
    {
        return DietType::OMNIVORE;
    }

    /**
     * Расчет количества пищи для медведя
     */
    public function calculateFoodAmount(): int
    {
        return 25; // Медведь потребляет много пищи
    }
}
