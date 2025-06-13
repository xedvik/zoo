<?php

namespace App\Animals\Reptiles;

use App\Animals\Enums\DietType;

class Crocodile extends AbstractReptile
{

    /**
     * Крокодил - хищник
     */
    public function getDietType(): string
    {
        return DietType::CARNIVORE;
    }

    /**
     * Перемещение крокодила
     */
    public function getMovementDescription(): string
    {
        return 'Плавает и ползает';
    }

    /**
     * Расчет количества пищи для крокодила
     */
    public function calculateFoodAmount(): int
    {
        return 20; // Крокодил потребляет много пищи
    }
}
