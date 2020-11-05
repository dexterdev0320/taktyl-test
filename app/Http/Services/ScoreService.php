<?php

namespace App\Http\Services;

use App\Http\Repositories\ScoreRepository;

class ScoreService
{
    /**
     * ScoreRepository
     *
     * @var mixed
     */
    private $ScoreRepository;

    /**
     * __construct
     *
     * @param  mixed $ScoreRepository
     * @return void
     */
    public function __construct(ScoreRepository $ScoreRepository)
    {
        $this->ScoreRepository = $ScoreRepository;
    }

    /**
     * generateRandomScore
     *
     * @param  mixed $request['min_number'] & $request['max_number']
     * @return Score
     */
    public function generateRandomScore($request)
    {
        try {
            $generated_score = rand($request['min_number'], $request['max_number']);
            return $this->ScoreRepository->storeScore($generated_score);
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
