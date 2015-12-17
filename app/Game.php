<?php

namespace App;

class Game
{
	protected $players;

	protected $dices;

	protected $view;

	protected $winner;

	public function __construct(View $view)
	{
		$this->view = $view;
	}

	public function addPlayer(Player $player)
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

	public function addDice(Dice $player)
	{
		$this->dices[] = $dice;

		return $this;
	}

	public function addDices(array $dices)
	{
		foreach ($dices as $dice) {
			$this->addDice($dice);
		}

		return $this;
	}

	public function isResultWinnig(array $result)
	{
		return false;
		// todo
	}

	public function setWinner(Player $player)
	{
		$this->winner = $player;
	}

	public function isThereAWinner()
	{
		return $this->winner instanceof Player;
	}

	public function run()
	{
		$this->view->displayStartGameMessage();

		$roundCount = 1;

		while (!$this->isThereAWinner()) {
			$this->view->displayNewRoundMessage($roundCount);

			foreach ($this->players as $player) {
				$result = $player->rollDices($this->dices);

				if ($this->isResultWinnig($result)) {
					$this->setWinner($player);
					break;
				}
			}
		}

		$this->view->displayEndGameMessage($player->getName());

		return $this;
	}
}
