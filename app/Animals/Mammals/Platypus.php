<?php

namespace App\Animals\Mammals;

use App\Animals\Enums\DietType;

/**
 * Класс утконоса
 */
class Platypus extends AbstractMammal
{
    /**
     * Утконос ядовит
     */
    public function isPoisonous(): bool
    {
        return true;
    }

    /**
     * Утконос откладывает яйца
     */
    public function isViviparous(): bool
    {
        return false;
    }

    /**
     * Утконос - хищник
     */
    public function getDietType(): string
    {
        return DietType::CARNIVORE;
    }


    /**
     * Расчет количества пищи для утконоса
     */
    public function calculateFoodAmount(): int
    {
        return 15; // Утконос потребляет среднее количество пищи
    }
}
