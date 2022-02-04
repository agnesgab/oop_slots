<?php

class Symbol
{

    private string $symbol;
    private int $value;


    public function __construct(string $symbol, int $value)
    {
        $this->symbol = $symbol;
        $this->value = $value;
    }


    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getValue(): int
    {
        return $this->value;
    }


}