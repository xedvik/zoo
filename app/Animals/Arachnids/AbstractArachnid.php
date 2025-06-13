<?php

namespace App\Animals\Arachnids;

use App\Animals\AbstractAnimal;

abstract class AbstractArachnid extends AbstractAnimal
{
    /**
     * Паукообразные всегда откладывают яйца
     */
    public function isViviparous(): bool
    {
        return false;
    }

    /**
     * Паукообразные не ядовитые
     */
    public function isPoisonous(): bool
    {
        return false;
    }

    /**
     * Паукообразные не летают
     */
    public function canFly(): bool
    {
        return false;
    }

    /**
     * Базовый расчет количества пищи для паукообразных
     */
    public function calculateFoodAmount(): int
    {
        return 5; // Паукообразные потребляют мало пищи
    }

    /**
     * Получить описание движения паукообразного
     */
    public function getMovementDescription(): string
    {
        return 'Передвигается на восьми лапах';
    }


    /**
     * Базовое размножение для паукообразных
     */
    public function reproduce(): void
    {
        // Базовая реализация размножения для паукообразных
        // Может быть переопределена в конкретных классах
    }
}
