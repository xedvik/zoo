<?php

namespace App\Animals\Reptiles;

use App\Animals\Enums\DietType;

class Cobra extends AbstractReptile
{

    /**
     * Кобра ядовита
     */
    public function isPoisonous(): bool
    {
        return true;
    }

    /**
     * Кобра - хищник
     */
    public function getDietType(): string
    {
        return DietType::CARNIVORE;
    }

    /**
     * Перемещение кобры
     */
    public function getMovementDescription(): string
    {
        return 'Ползает';
    }

    /**
     * Расчет количества пищи для кобры
     */
    public function calculateFoodAmount(): int
    {
        return 12; // Кобра потребляет среднее количество пищи
    }
}
