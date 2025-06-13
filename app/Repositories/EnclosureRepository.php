<?php

namespace App\Repositories;

use App\Models\Enclosure;
use App\Repositories\Interfaces\EnclosureRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Animal;

class EnclosureRepository implements EnclosureRepositoryInterface
{
    private Enclosure $model;

    public function __construct(Enclosure $model)
    {
        $this->model = $model;
    }

    /**
     * Получить все вольеры
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Получить вольер по ID
     * @param int $id
     * @return Enclosure|null
     */
    public function findById(int $id): ?Enclosure
    {
        return $this->model->find($id);
    }

    /**
     * Создать новый вольер
     * @param array $data
     * @return Enclosure
     */
    public function create(array $data): Enclosure
    {
        return $this->model->create($data);
    }

    /**
     * Обновить вольер
     * @param Enclosure $enclosure
     * @param array $data
     * @return bool
     */
    public function update(Enclosure $enclosure, array $data): bool
    {
        return $enclosure->update($data);
    }

    /**
     * Удалить вольер
     * @param Enclosure $enclosure
     * @return bool
     */
    public function delete(Enclosure $enclosure): bool
    {
        return $enclosure->delete();
    }

    /**
     * Проверяет, может ли вольер принять животное определенного класса
     * @param Enclosure $enclosure
     * @param string $animalClass Полное имя класса животного
     * @return bool
     */
    public function canAcceptAnimal(Enclosure $enclosure, string $animalClass): bool
    {
        // Проверяем, есть ли крыша для птиц
        if (strpos($animalClass, 'Birds\\') !== false && !$enclosure->has_roof) {
            return false;
        }

        // Проверяем, не заперт ли вольер
        if ($enclosure->is_locked) {
            return false;
        }

        // Проверяем, открыт ли вольер
        if (!$enclosure->is_open) {
            return false;
        }

        // Проверяем количество животных в вольере
        if ($enclosure->animals()->count() >= 5) {
            return false;
        }

        return true;
    }

    /**
     * Получить количество еды в вольере
     * @param Enclosure $enclosure
     * @return int
     */
    public function getFoodAmount(Enclosure $enclosure): int
    {
        return $enclosure->food_amount;
    }

    /**
     * Сохранить модель вольера
     * @param Enclosure $enclosure
     * @return bool
     */
    public function save(Enclosure $enclosure): bool
    {
        return $enclosure->save();
    }
}
