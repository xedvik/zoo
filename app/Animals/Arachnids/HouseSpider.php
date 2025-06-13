<?php

namespace App\Animals\Arachnids;

use App\Animals\Enums\DietType;

class HouseSpider extends AbstractArachnid
{

    /**
     * Домовой паук - хищник
     */
    public function getDietType(): string
    {
        return DietType::CARNIVORE;
    }


    /**
     * Расчет количества пищи для домового паука
     */
    public function calculateFoodAmount(): int
    {
        return 3; // Домовой паук потребляет очень мало пищи
    }
}
