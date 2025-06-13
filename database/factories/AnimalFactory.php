<?php

namespace Database\Factories;

use App\Animals\AbstractAnimal;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    /**
     * Маппинг классов животных
     */
    private const ANIMAL_CLASSES = [
        'mammal' => [
            'class' => 'mammal',
            'species' => 'App\Animals\Mammals\Lion',
            'satiety_range' => [50, 100],
            'age_range' => [1, 10]
        ],
        'bird' => [
            'class' => 'bird',
            'species' => 'App\Animals\Birds\Eagle',
            'satiety_range' => [40, 90],
            'age_range' => [1, 8]
        ],
        'reptile' => [
            'class' => 'reptile',
            'species' => 'App\Animals\Reptiles\Snake',
            'satiety_range' => [30, 80],
            'age_range' => [1, 15]
        ],
        'arachnid' => [
            'class' => 'arachnid',
            'species' => 'App\Animals\Arachnids\Spider',
            'satiety_range' => [20, 70],
            'age_range' => [1, 5]
        ]
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $animalClass = $this->faker->randomElement(array_keys(self::ANIMAL_CLASSES));
        $animalConfig = self::ANIMAL_CLASSES[$animalClass];

        return [
            'name' => $this->faker->firstName(),
            'gender' => $this->faker->randomElement([AbstractAnimal::GENDER_MALE, AbstractAnimal::GENDER_FEMALE]),
            'age' => $this->faker->numberBetween(...$animalConfig['age_range']),
            'satiety' => $this->faker->numberBetween(...$animalConfig['satiety_range']),
            'is_alive' => true,
            'class' => $animalConfig['class'],
            'species' => $animalConfig['species'],
        ];
    }

    /**
     * Состояние для млекопитающих
     */
    public function mammal()
    {
        $config = self::ANIMAL_CLASSES['mammal'];
        return $this->state(function (array $attributes) use ($config) {
            return [
                'class' => $config['class'],
                'species' => $config['species'],
                'satiety' => $this->faker->numberBetween(...$config['satiety_range']),
                'age' => $this->faker->numberBetween(...$config['age_range']),
            ];
        });
    }

    /**
     * Состояние для птиц
     */
    public function bird()
    {
        $config = self::ANIMAL_CLASSES['bird'];
        return $this->state(function (array $attributes) use ($config) {
            return [
                'class' => $config['class'],
                'species' => $config['species'],
                'satiety' => $this->faker->numberBetween(...$config['satiety_range']),
                'age' => $this->faker->numberBetween(...$config['age_range']),
            ];
        });
    }

    /**
     * Состояние для рептилий
     */
    public function reptile()
    {
        $config = self::ANIMAL_CLASSES['reptile'];
        return $this->state(function (array $attributes) use ($config) {
            return [
                'class' => $config['class'],
                'species' => $config['species'],
                'satiety' => $this->faker->numberBetween(...$config['satiety_range']),
                'age' => $this->faker->numberBetween(...$config['age_range']),
            ];
        });
    }

    /**
     * Состояние для паукообразных
     */
    public function arachnid()
    {
        $config = self::ANIMAL_CLASSES['arachnid'];
        return $this->state(function (array $attributes) use ($config) {
            return [
                'class' => $config['class'],
                'species' => $config['species'],
                'satiety' => $this->faker->numberBetween(...$config['satiety_range']),
                'age' => $this->faker->numberBetween(...$config['age_range']),
            ];
        });
    }
}
