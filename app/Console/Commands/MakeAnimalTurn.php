<?php

namespace App\Console\Commands;

use App\Services\AnimalTurnService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class MakeAnimalTurn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zoo:make-turn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Выполнить ход для всех животных в зоопарке';

    /**
     * @var AnimalTurnService
     */
    protected $animalTurnService;

    /**
     * Create a new command instance.
     */
    public function __construct(AnimalTurnService $animalTurnService)
    {
        parent::__construct();
        $this->animalTurnService = $animalTurnService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lock = Cache::lock('zoo:make-turn-lock', 300); // 300 секунд — 5 минут

        if (! $lock->get()) {
            $this->warn('Ход уже выполняется другим процессом.');
            return 0;
        }
        try {
            $this->info('Начинаем ход животных...');
            $this->animalTurnService->makeTurn();
            $this->info('Ход животных успешно завершен!');
        } catch (\Throwable $e) {
            $this->error('Ошибка при выполнении хода: ' . $e->getMessage());
            return 1;
        } finally {
            $lock->release(); // Освобождаем блокировку
        }

        return 0;
    }
}
