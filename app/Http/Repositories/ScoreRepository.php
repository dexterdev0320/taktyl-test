<?php

namespace App\Http\Repositories;

use App\Models\Score;
use Illuminate\Support\Facades\DB;

class ScoreRepository
{
    /**
     * Score
     *
     * @var mixed
     */
    private $Score;

    /**
     * __construct
     *
     * @param  mixed $Score
     * @return void
     */
    public function __construct(Score $Score)
    {
        $this->Score = $Score;
    }

    /**
     * getScores
     *
     * @return Scores
     */
    public function getScores()
    {
        // dd(now()->format('Y-m-d 00:00:00.00'));
        return $this->Score->select('score', DB::raw('count(id) as count'))->where('created_at', '>', now()->format('Y-m-d 00:00:00.00'))->groupBy('score')->orderBy('count', 'DESC')->get();
    }

    public function getScoreData($score)
    {
        return $this->Score->whereScore($score)->where('created_at', '>', now()->format('Y-m-d 00:00:00.00'))->get();
    }

    /**
     * storeScore
     *
     * @param  int $generated_score
     * @return Score
     */
    public function storeScore($generated_score)
    {
        try {
            DB::beginTransaction();
            $result = $this->Score->create([
                'score' => $generated_score
            ]);
            DB::commit();
            return $result;
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
        }
    }
}
