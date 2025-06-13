<?php

namespace App\Animals\Enums;

/**
 * Типы диеты животных
 */
class DietType
{
    public const CARNIVORE = 'carnivore';    // Хищник
    public const HERBIVORE = 'herbivore';    // Травоядный
    public const OMNIVORE = 'omnivore';      // Всеядный

    /**
     * Получить все доступные типы диеты
     * @return array
     */
    public static function getAll(): array
    {
        return [
            self::CARNIVORE,
            self::HERBIVORE,
            self::OMNIVORE
        ];
    }
}
