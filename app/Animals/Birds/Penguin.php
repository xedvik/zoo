<?php

namespace App\Animals\Birds;

use App\Animals\Enums\DietType;

class Penguin extends AbstractBird
{
    /**
     * Пингвин не летает
     */
    public function canFly(): bool
    {
        return false;
    }

    /**
     * Пингвин - хищник
     */
    public function getDietType(): string
    {
        return DietType::CARNIVORE;
    }

    /**
     * Перемещение пингвина
     */
    public function move(): string
    {
        return 'Ходит и плавает';
    }

    /**
     * Расчет количества пищи для пингвина
     */
    public function calculateFoodAmount(): int
    {
        return 10; // Пингвин потребляет среднее количество пищи
    }
}
