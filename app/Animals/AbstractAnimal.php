<?php

namespace App\Animals;

use App\Animals\Interfaces\AnimalInterface;
use App\Models\Animal;

abstract class AbstractAnimal implements AnimalInterface
{
    protected Animal $model;

    public function __construct(Animal $model)
    {
        $this->model = $model;
    }

    // Константы для пола
    public const GENDER_MALE = 'm'; // мужской пол
    public const GENDER_FEMALE = 'f'; // женский пол

    // Константы для сытости
    public const MIN_SATIETY = 0; // минимальная сытость
    public const MAX_SATIETY = 100; // максимальная сытость
    public const SATIETY_DECREASE_PER_TURN = 10; // уменьшение сытости за ход

    // Константы для возраста
    public const MIN_AGE = 0; // минимальный возраст
    public const MAX_AGE = 30; // максимальный возраст

    // Константы для размножения
    public const MIN_AGE_FOR_REPRODUCTION = 2; // минимальный возраст для размножения
    public const MIN_SATIETY_FOR_REPRODUCTION = 80; // минимальная сытость для размножения

    /**
     * Абстрактные методы, которые должны быть реализованы в дочерних классах
     */
    abstract public function canFly(): bool; // может ли животное летать
    abstract public function isPoisonous(): bool; // является ли животное ядовитым
    abstract public function isViviparous(): bool; // является ли животное живородящим
    abstract public function getDietType(): string; // получить тип питания
    abstract public function calculateFoodAmount(): int; // рассчитать количество еды
    abstract public function getMovementDescription(): string; // получить описание движения животного

    /**
     * Увеличение возраста
     */
    public function increaseAge(): void
    {
        $this->model->age++;
    }

    /**
     * Уменьшение сытости
     */
    public function decreaseSatiety(): void
    {
        $this->model->satiety = max(self::MIN_SATIETY, $this->model->satiety - self::SATIETY_DECREASE_PER_TURN);
    }

    /**
     * Питание из кормушки
     * @return int Количество съеденной еды
     */
    public function eat(): int
    {
        if (!$this->model->enclosure || !$this->model->is_alive) {
            return 0;
        }

        $needed = $this->calculateFoodAmount();

        if ($this->model->enclosure->food_amount >= $needed) {
            $this->model->satiety = min(self::MAX_SATIETY, $this->model->satiety + $needed);
            $this->model->enclosure->food_amount -= $needed;

            return $needed;
        }

        return 0;
    }

    /**
     * Размножение
     */
    public function reproduce(): void
    {
        // Заглушка
    }

    /**
     * Проверка возможности размножения
     */
    public function canReproduce(): bool
    {
        return $this->model->is_alive
            && $this->model->age >= self::MIN_AGE_FOR_REPRODUCTION
            && $this->model->satiety >= self::MIN_SATIETY_FOR_REPRODUCTION;
    }

    /**
     * Проверка смерти от старости
     */
    public function isDeadFromOldAge(): bool
    {
        return $this->model->age >= self::MAX_AGE;
    }

    /**
     * Проверка смерти от голода
     */
    public function isDeadFromHunger(): bool
    {
        return $this->model->satiety <= self::MIN_SATIETY;
    }

    /**
     * Проверка возможности движения
     * @return bool
     */
    public function canMove(): bool
    {
        return $this->model->is_alive
            && $this->model->enclosure
            && !$this->model->enclosure->is_locked;
    }

    /**
     * Получить описание движения с учетом состояния вальера
     * @return string
     */
    public function move(): string
    {
        return $this->canMove()
            ? $this->getMovementDescription()
            : 'не может двигаться';
    }

    public function getModel(): Animal
    {
        return $this->model;
    }

    /**
     * Получить текущий возраст животного
     *
     * @return int Возраст в годах
     */
    public function getAge(): int
    {
        return $this->model->age;
    }

    /**
     * Получить текущую сытость животного
     *
     * @return int Сытость в процентах
     */
    public function getSatiety(): int
    {
        return $this->model->satiety;
    }

    /**
     * Получить максимальный возраст животного
     *
     * @return int Максимальный возраст в годах
     */
    public function getMaxAge(): int
    {
        return self::MAX_AGE;
    }
}
