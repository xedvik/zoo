<?php

namespace Database\Seeders;

use App\Animals\AbstractAnimal;
use App\Animals\Arachnids\HouseSpider;
use App\Animals\Arachnids\Tarantula;
use App\Animals\Birds\Parrot;
use App\Animals\Birds\Penguin;
use App\Animals\Mammals\Bear;
use App\Animals\Mammals\Gazelle;
use App\Animals\Mammals\Platypus;
use App\Animals\Mammals\Wolf;
use App\Animals\Reptiles\Cobra;
use App\Animals\Reptiles\Crocodile;
use App\Animals\Reptiles\Snake;
use App\Repositories\Interfaces\AnimalRepositoryInterface;
use App\Repositories\Interfaces\EnclosureRepositoryInterface;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * @var EnclosureRepositoryInterface
     */
    private $enclosureRepository;

    /**
     * @var AnimalRepositoryInterface
     */
    private $animalRepository;

    public function __construct(
        EnclosureRepositoryInterface $enclosureRepository,
        AnimalRepositoryInterface $animalRepository
    ) {
        $this->enclosureRepository = $enclosureRepository;
        $this->animalRepository = $animalRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // Получаем все вольеры
        $enclosures = $this->enclosureRepository->getAll();

        if ($enclosures->isEmpty()) {
            $this->command->error('Нет доступных вольеров для размещения животных!');
            return;
        }

        // Массив всех доступных животных с указанием типа вольера
        $animals = [
            // Млекопитающие
            Bear::class => ['name' => 'Медведь', 'class' => 'mammal', 'enclosure_type' => 'forest'],
            Wolf::class => ['name' => 'Волк', 'class' => 'mammal', 'enclosure_type' => 'forest'],
            Platypus::class => ['name' => 'Утконос', 'class' => 'mammal', 'enclosure_type' => 'water'],
            Gazelle::class => ['name' => 'Газель', 'class' => 'mammal', 'enclosure_type' => 'savanna'],

            // Птицы
            Penguin::class => ['name' => 'Пингвин', 'class' => 'bird', 'enclosure_type' => 'water'],
            Parrot::class => ['name' => 'Попугай', 'class' => 'bird', 'enclosure_type' => 'forest'],

            // Рептилии
            Snake::class => ['name' => 'Змея', 'class' => 'reptile', 'enclosure_type' => 'desert'],
            Cobra::class => ['name' => 'Кобра', 'class' => 'reptile', 'enclosure_type' => 'desert'],
            Crocodile::class => ['name' => 'Крокодил', 'class' => 'reptile', 'enclosure_type' => 'water'],

            // Паукообразные
            Tarantula::class => ['name' => 'Тарантул', 'class' => 'arachnid', 'enclosure_type' => 'desert'],
            HouseSpider::class => ['name' => 'Домашний паук', 'class' => 'arachnid', 'enclosure_type' => 'desert'],
        ];

        $createdCount = 0;
        $usedEnclosures = [];

        // Группируем вольеры по типу
        $enclosuresByType = [];
        foreach ($enclosures as $enclosure) {
            $enclosuresByType[$enclosure->type][] = $enclosure;
        }

        // Размещаем животных по вольерам
        foreach ($animals as $animalClass => $info) {
            $count = rand(2, 3);

            // Получаем вольеры подходящего типа
            $suitableEnclosures = $enclosuresByType[$info['enclosure_type']] ?? [];

            if (empty($suitableEnclosures)) {
                $this->command->warn("Нет вольеров типа {$info['enclosure_type']} для {$info['name']}");
                continue;
            }

            // Выбираем первый свободный вольер подходящего типа
            $suitableEnclosure = null;
            foreach ($suitableEnclosures as $enclosure) {
                if (!in_array($enclosure->id, $usedEnclosures) &&
                    $this->enclosureRepository->canAcceptAnimal($enclosure, $animalClass)) {
                    $suitableEnclosure = $enclosure;
                    $usedEnclosures[] = $enclosure->id;
                    break;
                }
            }

            if (!$suitableEnclosure) {
                $this->command->warn("Не найден свободный вольер типа {$info['enclosure_type']} для {$info['name']}");
                continue;
            }

            // Создаем группу животных одного вида в одном вольере
            for ($i = 0; $i < $count; $i++) {
                // Создаем животное через репозиторий
                $this->animalRepository->create([
                    'name' => $info['name'] . ' ' . ($i + 1),
                    'class' => $info['class'],
                    'species' => $animalClass,
                    'enclosure_id' => $suitableEnclosure->id,
                    'gender' => $faker->randomElement([AbstractAnimal::GENDER_MALE, AbstractAnimal::GENDER_FEMALE]),
                    'age' => $faker->numberBetween(0, 10),
                    'satiety' => $faker->numberBetween(50, 100),
                    'is_alive' => true,
                ]);

                $createdCount++;
            }
        }

        $this->command->info("Животные успешно созданы: {$createdCount}");

        // Выводим статистику по вольерам
        $this->command->info("\nСтатистика по вольерам:");
        foreach ($enclosuresByType as $type => $typeEnclosures) {
            $usedCount = count(array_intersect($usedEnclosures, collect($typeEnclosures)->pluck('id')->toArray()));
            $this->command->info("- {$type}: использовано {$usedCount} из " . count($typeEnclosures));
        }
    }
}
