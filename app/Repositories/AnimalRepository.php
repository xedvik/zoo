<?php

namespace App\Repositories;

use App\Models\Animal;
use App\Repositories\Interfaces\AnimalRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class AnimalRepository implements AnimalRepositoryInterface
{
    /**
     * @var Animal
     */
    private Animal $model;


    public function __construct(Animal $model)
    {
        $this->model = $model;
    }




    /**
     * Получить всех живых животных с загруженными вольерами
     * @return Collection
     */
    public function getAliveAnimalsWithEnclosures(): Collection
    {
        return $this->model
            ->where('is_alive', true)
            ->with('enclosure')
            ->get();
    }

    /**
     * Найти животное по ID
     * @param int $id
     * @return Animal|null
     */
    public function findById(int $id): ?Animal
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Создать новое животное
     * @param array $data
     * @return Animal
     */
    public function create(array $data): Animal
    {
        return $this->model->create($data);
    }

    /**
     * Обновить животное
     * @param Animal $animal
     * @param array $data
     * @return bool
     */
    public function update(Animal $animal, array $data): bool
    {
        return $animal->update($data);
    }

    /**
     * Удалить животное
     * @param Animal $animal
     * @return bool
     */
    public function delete(Animal $animal): bool
    {
        return $animal->delete();
    }


    /**
     * Сохранить модель животного
     *
     * @param Animal $animal
     * @return bool
     */
    public function save(Animal $animal): bool
    {
        return $animal->save();
    }
}
