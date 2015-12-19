<?php

require __DIR__ . '/vendor/autoload.php';

use App\GameLog\GameLog;
use App\Game\Game;
use App\Dice\Dice;
use App\Player\Player;

$game = new Game(new GameLog);

$game->addDices([
	new Dice,
	new Dice,
	new Dice,
]);

$game->addPlayers([
	new Player('Harry'),
	new Player('Lucjan'),
	new Player('Bartek'),
	new Player('Duszek')
]);

$game->run();

var_dump($game->getGameReportAsArray());