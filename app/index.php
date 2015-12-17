<?php

use App\Player;

$players = [
	new Player('Harry'),
	new Player('Lucjan'),
	new Player('Bartek'),
	new Player('Duszek'),
];

$dices = [
	new Dice,
	new Dice,
	new Dice,
];

$referee = new Referee;
$view = new View;

foreach ($players as $player) {
	$view->pushNewTurnMessage();

	$results = $player->rollDices($dices);

	$view->pushNewTurnMessage();

	if ($referee->)
}
