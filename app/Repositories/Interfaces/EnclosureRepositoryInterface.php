<?php

namespace App\Repositories\Interfaces;

use App\Models\Enclosure;
use Illuminate\Database\Eloquent\Collection;

interface EnclosureRepositoryInterface
{
    /**
     * Получить все вольеры
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Получить вольер по ID
     * @param int $id
     * @return Enclosure|null
     */
    public function findById(int $id): ?Enclosure;

    /**
     * Создать новый вольер
     * @param array $data
     * @return Enclosure
     */
    public function create(array $data): Enclosure;

    /**
     * Обновить вольер
     * @param Enclosure $enclosure
     * @param array $data
     * @return bool
     */
    public function update(Enclosure $enclosure, array $data): bool;

    /**
     * Удалить вольер
     * @param Enclosure $enclosure
     * @return bool
     */
    public function delete(Enclosure $enclosure): bool;

    /**
     * Проверяет, может ли вольер принять животное определенного класса
     *
     * @param Enclosure $enclosure
     * @param string $animalClass
     * @return bool
     */
    public function canAcceptAnimal(Enclosure $enclosure, string $animalClass): bool;

    /**
     * Получить количество еды в вольере
     *
     * @param Enclosure $enclosure
     * @return int
     */
    public function getFoodAmount(Enclosure $enclosure): int;


    /**
     * Сохранить модель вольера
     *
     * @param Enclosure $enclosure
     * @return bool
     */
    public function save(Enclosure $enclosure): bool;
}
