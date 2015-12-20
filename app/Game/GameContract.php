<?php

namespace App\Game;

use App\Player\PlayerContract;
use App\GameLog\GameLogContract;

interface GameContract
{
	public function addPlayer(PlayerContract $player);
	public function addPlayers(array $players);
	public function getPlayers();

	public function addDices(array $dices);
	public function getDices();

	public function isResultWinnig(array $result);
	public function setWinner(PlayerContract $player);
	public function getWinner();
	public function thereIsNoWinner();

	public function run();

	public function getGameReportAsArray();
}
