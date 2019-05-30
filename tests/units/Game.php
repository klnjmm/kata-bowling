<?php

namespace Klnjmm\tests\units;

class Game extends \atoum
{
    public function test_that_score_equal_zero_when_no_pins_down()
    {
        $this->newTestedInstance;
        $this->rolls(0);

        $this->integer($this->testedInstance->score())->isIdenticalTo(0);
    }

    public function test_that_score_equal_20_when_1_pin_down_at_each_roll()
    {
        $this->newTestedInstance;
        $this->rolls(1);

        $this->integer($this->testedInstance->score())->isIdenticalTo(20);
    }

    public function test_that_spare_is_handled()
    {
        $this->newTestedInstance;
        $this->testedInstance->roll(6);
        $this->testedInstance->roll(4);
        $this->testedInstance->roll(7);

        $this->rolls(0, 17);

        $this->integer($this->testedInstance->score())->isIdenticalTo(24);
    }

    public function test_that_strike_is_handled()
    {
        $this->newTestedInstance;
        $this->testedInstance->roll(10);
        $this->testedInstance->roll(4);
        $this->testedInstance->roll(5);

        $this->rolls(0, 17);

        $this->integer($this->testedInstance->score())->isIdenticalTo(28);
    }

    public function test_that_last_frame_has_3_roll_when_spare()
    {
        $this->newTestedInstance;
        $this->rolls(0, 18);

        $this->testedInstance->roll(6);
        $this->testedInstance->roll(4);
        $this->testedInstance->roll(5);

        $this->integer($this->testedInstance->score())->isIdenticalTo(15);
    }

    public function test_that_last_frame_has_3_roll_when_strike()
    {
        $this->newTestedInstance;
        $this->rolls(0, 18);

        $this->testedInstance->roll(10);
        $this->testedInstance->roll(4);
        $this->testedInstance->roll(5);

        $this->integer($this->testedInstance->score())->isIdenticalTo(19);
    }
    
    public function test_that_perfect_game_return_300()
    {
        $this->newTestedInstance;
        $this->rolls(10, 12);
        
        $this->integer($this->testedInstance->score())->isIdenticalTo(300);
    }

    private function rolls(int $pins, int $rollNumber = 20)
    {
        for ($roll = 1; $roll <= $rollNumber; $roll++) {
            $this->testedInstance->roll($pins);
        }
    }
}
