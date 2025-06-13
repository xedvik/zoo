<?php

namespace App\Repositories;

use App\Models\Animal;
use App\Models\Biography;
use App\Repositories\Interfaces\BiographyRepositoryInterface;

class BiographyRepository implements BiographyRepositoryInterface
{
    /**
     * Создать запись в биографии
     */
    public function create(Animal $animal, string $message): Biography
    {
        return Biography::create([
            'animal_id' => $animal->id,
            'message' => $message
        ]);
    }
}
