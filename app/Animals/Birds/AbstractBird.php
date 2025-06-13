<?php

namespace App\Animals\Birds;

use App\Animals\AbstractAnimal;

abstract class AbstractBird extends AbstractAnimal
{
    /**
     * Птицы всегда откладывают яйца
     */
    public function isViviparous(): bool
    {
        return false;
    }

    /**
     * Птицы всегда летают
     */
    public function canFly(): bool
    {
        return true;
    }

    /**
     * Птицы не ядовитые
     */
    public function isPoisonous(): bool
    {
        return false;
    }

    /**
     * Базовый расчет количества пищи для птиц
     */
    public function calculateFoodAmount(): int
    {
        return 8; // Птицы потребляют меньше пищи
    }

    /**
     * Получить описание движения птицы
     */
    public function getMovementDescription(): string
    {
        return 'Летает';
    }

    /**
     * Базовое размножение для птиц
     */
    public function reproduce(): void
    {
        // Базовая реализация размножения для птиц
        // Может быть переопределена в конкретных классах
    }
}
