<?php

namespace Database\Factories;

use App\Models\Enclosure;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnclosureFactory extends Factory
{
    protected $model = Enclosure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['forest', 'water', 'desert', 'savanna']),
            'is_open' => true,
            'is_locked' => false,
            'has_roof' => false,
            'food_type' => 'meat',
            'food_amount' => $this->faker->numberBetween(100, 500),
        ];
    }

    /**
     * Указать, что вольер закрыт
     */
    public function locked(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_locked' => true,
            ];
        });
    }

    /**
     * Указать, что вольер открыт
     */
    public function open(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_open' => true,
                'is_locked' => false,
            ];
        });
    }

    /**
     * Указать, что вольер с крышей
     */
    public function withRoof(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'has_roof' => true,
            ];
        });
    }

    /**
     * Указать, что вольер для мясоедов
     */
    public function meatEaters(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'food_type' => 'meat',
            ];
        });
    }

    /**
     * Указать, что вольер для травоядных
     */
    public function herbivores(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'food_type' => 'plants',
            ];
        });
    }

    /**
     * Указать, что вольер пустой (нет еды)
     */
    public function empty(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'food_amount' => 0,
            ];
        });
    }

    /**
     * Указать, что вольер полный (много еды)
     */
    public function full(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'food_amount' => $this->faker->numberBetween(400, 500),
            ];
        });
    }

    public function forest(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'forest',
                'has_roof' => true,
                'food_type' => 'meat',
            ];
        });
    }

    public function water(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'water',
                'has_roof' => false,
                'food_type' => 'fish',
            ];
        });
    }

    public function desert(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'desert',
                'has_roof' => false,
                'food_type' => 'insects',
            ];
        });
    }

    public function savanna(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => 'savanna',
                'has_roof' => false,
                'food_type' => 'grass',
            ];
        });
    }
}
