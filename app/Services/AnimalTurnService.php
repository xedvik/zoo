<?php

namespace App\Services;

use App\Animals\AbstractAnimal;
use App\Models\Animal;
use App\Repositories\Interfaces\AnimalRepositoryInterface;
use App\Repositories\Interfaces\BiographyRepositoryInterface;
use App\Repositories\Interfaces\EnclosureRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

/**
 * Сервис для обработки ходов животных
 *
 * Сервис работает с абстрактными животными (AbstractAnimal), но использует
 * метод getModel() для доступа к модели Animal при взаимодействии с репозиториями
 */
class AnimalTurnService
{
    /**
     * @var AnimalRepositoryInterface
     */
    private $animalRepository;

    /**
     * @var BiographyRepositoryInterface
     */
    private $biographyRepository;

    /**
     * @var EnclosureRepositoryInterface
     */
    private $enclosureRepository;

    public function __construct(
        AnimalRepositoryInterface $animalRepository,
        BiographyRepositoryInterface $biographyRepository,
        EnclosureRepositoryInterface $enclosureRepository
    ) {
        $this->animalRepository = $animalRepository;
        $this->biographyRepository = $biographyRepository;
        $this->enclosureRepository = $enclosureRepository;
    }

    /**
     * Выполнить ход для всех животных
     *
     * @return bool Успешно ли выполнены все ходы
     */
    public function makeTurn(): bool
    {
        $hasErrors = false;

        $animals = $this->animalRepository->getAliveAnimalsWithEnclosures();
        $abstractAnimals = $animals->map(function ($animal) {
            return $this->createAbstractAnimal($animal);
        });

        foreach ($abstractAnimals as $animal) {
            DB::beginTransaction();

            try {
                $this->processAnimalTurn($animal);
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();

                $model = $animal->getModel();
                $id = $model->id ?? 'unknown';
                Log::error("Ошибка при обработке животного ID {$id}: " . $e->getMessage());

                $hasErrors = true;
            }
        }

        return !$hasErrors;
    }


    /**
     * Обработать ход одного животного
     *
     * @param AbstractAnimal $animal Абстрактное животное для обработки
     * @throws \Exception
     */
    private function processAnimalTurn(AbstractAnimal $animal): void
    {
        $model = $animal->getModel();

        $animal->increaseAge();
        $this->log($animal, sprintf(
            'Животное стало старше на 1 год (текущий возраст: %d лет)',
            $animal->getAge()
        ));

        if ($animal->isDeadFromOldAge()) {
            $model->is_alive = false;
            $this->log($animal, sprintf(
                'Животное умерло от старости в возрасте %d лет (максимальный возраст: %d лет)',
                $animal->getAge(),
                $animal->getMaxAge()
            ));
            $this->animalRepository->save($model);
            return;
        }

        $animal->decreaseSatiety();
        $this->log($animal, sprintf(
            'Животное стало голоднее (текущая сытость: %d%%)',
            $animal->getSatiety()
        ));

        if ($animal->isDeadFromHunger()) {
            $model->is_alive = false;
            $this->log($animal, sprintf(
                'Животное умерло от голода (сытость: %d%%)',
                $animal->getSatiety()
            ));
            $this->animalRepository->save($model);
            return;
        }

        // Питание
        $eaten = $animal->eat();
        if ($eaten > 0) {
            $this->log($animal, sprintf(
                'Животное поело %d единиц еды (текущая сытость: %d%%)',
                $eaten,
                $animal->getSatiety()
            ));

            // Еда уменьшена в enclosure — сохраняем его
            $enclosure = $model->enclosure()->first();
            $this->enclosureRepository->save($enclosure);
            $this->log($animal, sprintf(
                'В вольере осталось %d единиц еды',
                $this->enclosureRepository->getFoodAmount($enclosure)
            ));
        } else {
            $this->log($animal, sprintf(
                'Животное не может поесть — нет еды в вольере (текущая сытость: %d%%)',
                $animal->getSatiety()
            ));
        }

        // Движение
        $movement = $animal->move();
        $this->log($animal, sprintf(
            'Животное %s (текущая сытость: %d%%)',
            $movement,
            $animal->getSatiety()
        ));

        // Размножение
        if ($animal->canReproduce()) {
            $animal->reproduce();
            $text = $model->gender === AbstractAnimal::GENDER_FEMALE
                ? 'Самка готова к размножению (текущая сытость: %d%%)'
                : 'Самец ищет самку для размножения (текущая сытость: %d%%)';
            $this->log($animal, sprintf($text, $animal->getSatiety()));
        }

        // Финальное сохранение животного
        $this->animalRepository->save($model);
    }

    /**
     * Создать абстрактное животное из модели
     *
     * @param Animal $animal Модель животного
     * @return AbstractAnimal Абстрактное животное
     */
    private function createAbstractAnimal(Animal $animal): AbstractAnimal
    {
        $class = $animal->species;
        return new $class($animal); // Конструктор принимает модель
    }

    private function log(AbstractAnimal $animal, string $message): void
    {
        $this->biographyRepository->create($animal->getModel(), $message);
    }
}
