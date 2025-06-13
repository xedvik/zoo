<?php

namespace App\Animals\Reptiles;

use App\Animals\AbstractAnimal;

abstract class AbstractReptile extends AbstractAnimal
{
    /**
     * Рептилии всегда откладывают яйца
     */
    public function isViviparous(): bool
    {
        return false;
    }

    /**
     * Рептилии не ядовитые
     */
    public function isPoisonous(): bool
    {
        return false;
    }

    /**
     * Рептилии не летают
     */
    public function canFly(): bool
    {
        return false;
    }

    /**
     * Базовый расчет количества пищи для рептилий
     */
    public function calculateFoodAmount(): int
    {
        return 12; // Рептилии потребляют среднее количество пищи
    }

    /**
     * Базовое перемещение для рептилий
     */
    public function getMovementDescription(): string
    {
        return 'Передвигается на четырех лапах';
    }

    /**
     * Базовое размножение для рептилий
     */
    public function reproduce(): void
    {
        // Базовая реализация размножения для рептилий
        // Может быть переопределена в конкретных классах
    }
}
