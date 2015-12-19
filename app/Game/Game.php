<?php

namespace App\Game;

use App\Player\PlayerContract;
use App\GameLog\GameLogContract;
use App\Dice\DiceContract;

// todo Implement contract
class Game
{
	protected $log;

	protected $players = [];

	protected $dices = [];

	protected $winner = null;

	public function __construct(GameLogContract $log)
	{
		$this->log = $log;
	}

	public function addPlayer(PlayerContract $player)
	{
		$this->players[] = $player;

		return $this;
	}

	public function addPlayers(array $players)
	{
		foreach ($players as $player) {
			$this->addPlayer($player);
		}

		return $this;
	}

	public function getPlayers()
	{
		return $this->players;
	}

	private function addDice(DiceContract $dice)
	{
		$this->dices[] = $dice;

		return $this;
	}

	public function addDices(array $dices)
	{
		if (count($dices) != 3) {
			throw new \InvalidArgumentException('You can only add three dices for this game to make sense.');
		}

		foreach ($dices as $dice) {
			$this->addDice($dice);
		}

		return $this;
	}

	public function getDices()
	{
		return $this->dices;
	}

	public function isResultWinnig(array $result)
	{
		return !$this->thereIsNoPair($result) and !$this->thereIsNoSixOrOne($result);
	}

	private function thereIsNoPair(array $result)
	{
		return $result == array_unique($result);
	}

	private function thereIsNoSixOrOne(array $result)
	{
		return !in_array(1, $result) and !in_array(6, $result);
	}

	public function setWinner(PlayerContract $player)
	{
		$this->winner = $player;
	}

	public function getWinner()
	{
		return $this->winner;
	}

	public function thereIsNoWinner()
	{
		return $this->winner == null;
	}

	public function run()
	{
		$this->log->gameStarts();

		$roundCount = 1;
		$roundCountLimit = 300;

		while ($this->thereIsNoWinner()) {

			if ($roundCount > $roundCountLimit) {
				$this->log->nobodyWins();
				break;
			}

			$this->log->newRoundStarts($roundCount);

			foreach ($this->players as $player) {

				$result = $player->rollDices($this->dices);

				if ($this->isResultWinnig($result)) {
					$this->setWinner($player);
					$this->log->playerWins($player->getName());
					break;
				}
			}

			$roundCount++;
		}

		$this->log->gameEnds();

		return $this;
	}
}
