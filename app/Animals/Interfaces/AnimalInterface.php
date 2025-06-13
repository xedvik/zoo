<?php

namespace App\Animals\Interfaces;

use App\Animals\Enums\DietType;

/**
 * Интерфейс для всех животных
 */
interface AnimalInterface
{
    /**
     * Получить тип диеты животного
     * @return string Один из типов из DietType
     */
    public function getDietType(): string;

    /**
     * Может ли животное летать
     */
    public function canFly(): bool;

    /**
     * Ядовитое ли животное
     */
    public function isPoisonous(): bool;

    /**
     * Живородящее ли животное
     */
    public function isViviparous(): bool;

    /**
     * Получить способ передвижения животного
     */
    public function move(): string;

    /**
     * Рассчитать количество еды для животного
     */
    public function calculateFoodAmount(): int;

    /**
     * Проверка возможности движения
     */
    public function canMove(): bool;

    /**
     * Проверка возможности размножения
     */
    public function canReproduce(): bool;

    /**
     * Получить описание движения животного
     */
    public function getMovementDescription(): string;

}
