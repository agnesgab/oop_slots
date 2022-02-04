<?php

class Board
{

    private int $rows;
    private int $columns;
    private array $board;
    private Player $player;
    private array $combinations;
    private array $symbols;
    private array $a;

    public function __construct(int $rows, int $columns, int $cash, int $spinRate)
    {

        $this->rows = $rows;
        $this->columns = $columns;

        $this->board = array_fill(0, $this->rows, array_fill(0, $this->columns, '-'));

        $this->player = new Player($cash, $spinRate);

        $this->symbols = [
            new Symbol('X', 5),
            new Symbol('O', 2),
            new Symbol('*', 10)
        ];

        $this->combinations = [
            [
                [0, 0], [0, 1], [0, 2]
            ],
            [
                [1, 0], [1, 1], [1, 2]
            ],
            [
                [2, 0], [2, 1], [2, 2]
            ],
            [
                [2, 0], [1, 1], [0, 2]
            ],
            [
                [0, 0], [1, 1], [2, 2]
            ],

        ];
    }


    public function drawBoard()
    {
        $this->replaceWithSymbols();

        foreach ($this->board as $item) {
            foreach ($item as $value) {
                echo " $value ";
            }
            echo PHP_EOL;
        }

    }

    public function getOnlySymbols(): array
    {

        foreach ($this->symbols as $symbol) {
            $this->a[] = $symbol->getSymbol();
        }
        return $this->a;
    }

    public function replaceWithSymbols(): array
    {
        $this->getOnlySymbols();
        foreach ($this->board as $row => $item) {
            foreach ($item as $column => $value) {
                $this->board[$row][$column] = $this->a[array_rand($this->a)];
            }
        }
        return $this->board;
    }

    function getBoardCombinations(): array
    {

        $someArray = [];

        foreach ($this->combinations as $index => $combination) {
            foreach ($combination as $i => $combo) {
                [$row, $column] = $combo;
                $someArray[$index][$i] = $this->board[$row][$column];
            }
        }

        return $someArray;
    }

    public function getWinningSymbol(): array
    {

        $winSymbol = [];
        foreach ($this->getBoardCombinations() as $combo) {
            if (count(array_unique($combo)) === 1) {
                $winSymbol[] = $combo[0];
            }
        }

        return $winSymbol;

    }

    public function getMoneyForSymbol()
    {

        $this->player->cashMinusSpinRate();
        echo "Cash: " . $this->player->getCash() . "EUR" . PHP_EOL;

        foreach ($this->getWinningSymbol() as $symbol) {
            foreach ($this->symbols as $s) {
                if ($symbol == $s->getSymbol()) {
                    $win = $s->getValue() * $this->player->getSpinRate();
                    $this->player->cashPlusWin($win);
                    echo "You won " . $win . "EUR!" . PHP_EOL;
                    return "Cash: " . $this->player->getCash() . "EUR" . PHP_EOL;
                }
            }
        }

    }

    public function validateCash(): bool
    {
        if ($this->player->getCash() < $this->player->getSpinRate()) {
            echo "Game over. Not enough cash." . PHP_EOL;
            return false;
        }

        return true;
    }

}