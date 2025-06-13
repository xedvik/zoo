<?php

namespace App\Animals\Mammals;

use App\Animals\AbstractAnimal;

abstract class AbstractMammal extends AbstractAnimal
{
    /**
     * Млекопитающие всегда живородящие
     */
    public function isViviparous(): bool
    {
        return true;
    }

    /**
     * Млекопитающие не ядовитые
     */
    public function isPoisonous(): bool
    {
        return false;
    }

    /**
     * Млекопитающие не летают
     */
    public function canFly(): bool
    {
        return false;
    }

    /**
     * Базовый расчет количества пищи для млекопитающих
     */
    public function calculateFoodAmount(): int
    {
        return 15; // Млекопитающие потребляют больше пищи
    }

    /**
     * Получить описание движения млекопитающего
     */
    public function getMovementDescription(): string
    {
        return 'Передвигается на четырех лапах';
    }

    /**
     * Базовое размножение для млекопитающих
     */
    public function reproduce(): void
    {
        // Базовая реализация размножения для млекопитающих
        // Может быть переопределена в конкретных классах
    }
}
