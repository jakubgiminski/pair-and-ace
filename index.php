<?php

require __DIR__ . '/vendor/autoload.php';

use App\GameLog\GameLog;
use App\Game\Game;
use App\Dice\Dice;
use App\Player\Player;

$game = new Game(new GameLog);

$game->addDices([
	new dice,
	new dice,
	new dice,
]);

$game->addPlayers([
	new player('Harry'),
	new player('Lucjan'),
	new player('Bartek'),
	new player('Duszek')
]);

$game->run();

var_dump($game->getGameReportAsArray());
