<?php

namespace Klnjmm;

class Game
{
    private $rolls = [];

    public function roll(int $pins)
    {
        $this->rolls[] = $pins;
    }

    public function score()
    {
        $score = 0;

        $roll = 0;
        for ($frame = 1; $frame <= 10; $frame++) {
            if ($this->isStrike($roll)) {
                $score += $this->rolls[$roll] + $this->rolls[$roll+1] + $this->rolls[$roll+2];
                $roll++;
            } elseif ($this->isSpare($roll)) {
                $score += $this->rolls[$roll] + $this->rolls[$roll+1] + $this->rolls[$roll+2];
                $roll += 2;
            } else {
                $score += $this->rolls[$roll] + $this->rolls[$roll + 1];
                $roll += 2;
            }
        }

        return $score;
    }

    private function isSpare($roll): bool
    {
        return ($this->rolls[$roll] + $this->rolls[$roll + 1]) === 10;
    }

    private function isStrike($roll): bool
    {
        return $this->rolls[$roll] === 10;
    }
}
