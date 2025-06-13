<?php

namespace App\Repositories\Interfaces;

use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;

interface AnimalRepositoryInterface
{

    public function getAliveAnimalsWithEnclosures(): Collection;

    /**
     * Найти животное по ID
     * @param int $id
     * @return Animal|null
     */
    public function findById(int $id): ?Animal;

    /**
     * Создать новое животное
     * @param array $data
     * @return Animal
     */
    public function create(array $data): Animal;

    /**
     * Обновить животное
     * @param Animal $animal
     * @param array $data
     * @return bool
     */
    public function update(Animal $animal, array $data): bool;

    /**
     * Удалить животное
     * @param Animal $animal
     * @return bool
     */
    public function delete(Animal $animal): bool;


    public function save(Animal $animal): bool;
}
