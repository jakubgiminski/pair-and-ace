<?php

namespace App\Game;

use App\View\ViewContract;
use App\Dice\DiceContract;

// todo Implement contract
class Game
{
	protected $view;

	protected $players = [];

	protected $dices = [];

	protected $winner = null;

	public function __construct(ViewContract $view)
	{
		$this->view = $view;
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

	private function isResultWinnig(array $result)
	{
		return false;
		// todo
	}

	private function setWinner(Player $player)
	{
		$this->winner = $player;
	}

	private function thereIsNoWinner()
	{
		return !$this->winner instanceof Player;
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
