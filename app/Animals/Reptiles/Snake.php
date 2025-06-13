<?php

namespace App\Animals\Reptiles;

use App\Animals\Enums\DietType;

class Snake extends AbstractReptile
{

    /**
     * Уж - хищник
     */
    public function getDietType(): string
    {
        return DietType::CARNIVORE;
    }

    /**
     * Получить описание движения змеи
     */
    public function getMovementDescription(): string
    {
        return 'Ползает';
    }

    /**
     * Расчет количества пищи для ужа
     */
    public function calculateFoodAmount(): int
    {
        return 10; // Уж потребляет среднее количество пищи
    }
}
