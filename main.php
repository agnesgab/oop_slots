<?php

require_once 'Player.php';
require_once 'Symbol.php';
require_once 'Board.php';

$cash = (int)readline('Money amount: ');
$spinRate = (int)readline('Spin rate: ');
$game = new Board(3, 3, $cash, $spinRate);
$player = new Player($cash, $spinRate);

while ($game->validateCash()) {
    readline('ENTER to spin');
    $game->drawBoard();
    echo $game->getMoneyForSymbol();
}