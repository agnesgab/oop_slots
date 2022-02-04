<?php

class Player
{
    private int $cash;
    private int $spinRate;


    public function __construct(int $cash, int $spinRate)
    {
        $this->cash = $cash;
        $this->spinRate = $spinRate;
    }

    public function getCash(): int
    {
        return $this->cash;
    }

    public function getSpinRate(): int
    {
        return $this->spinRate;
    }

    public function cashMinusSpinRate()
    {
        $this->cash -= $this->spinRate;
    }

    public function cashPlusWin(int $value)
    {
        $this->cash += $value;
    }


}