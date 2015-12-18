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

	private function addPlayer(Player $player)
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

	private function addDice(Dice $player)
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
		$this->view->displayStartGameMessage();

		$roundCount = 1;
		$roundCountLimit = 300;

		while ($this->thereIsNoWinner()) {

			if ($roundCount > $roundCountLimit) {
				$this->view->displayNoLuckMessage();
				break;
			}

			$this->view->displayNewRoundMessage($roundCount);

			foreach ($this->players as $player) {

				$result = $player->rollDices($this->dices);

				if ($this->isResultWinnig($result)) {
					$this->setWinner($player);
					$this->view->displayWinnerMessage($player->getName());
					break;
				}
			}

			$roundCount++;
		}

		$this->view->displayGameFinishedMessage();

		return $this;
	}
}
