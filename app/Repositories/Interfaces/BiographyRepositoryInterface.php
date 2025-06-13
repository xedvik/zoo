<?php

namespace App\Repositories\Interfaces;

use App\Models\Animal;
use App\Models\Biography;

interface BiographyRepositoryInterface
{
    /**
     * Создать запись в биографии
     */
    public function create(Animal $animal, string $message): Biography;
}
