<?php

namespace App\Game;

use App\Player\PlayerContract;

interface GameContract
{
    /**
     * @param PlayerContract $player
     * @return self
     */
	public function addPlayer(PlayerContract $player);

    /**
     * @param array $players
     * @return self
     */
	public function addPlayers(array $players);

    /**
     * @return array
     */
	public function getPlayers();

    /**
     * @param array $dices
     * @throws \InvalidArgumentException
     * @return self
     */
	public function addDices(array $dices);

    /**
     * @return array
     */
	public function getDices();

    /**
     * @param array $result
     * @return bool
     */
	public function isResultWinnig(array $result);

    /**
     * @param PlayerContract $player
     */
	public function setWinner(PlayerContract $player);

    /**
     * @return null|PlayerContract
     */
	public function getWinner();

    /**
     * @return bool
     */
	public function thereIsNoWinner();

    /**
     * @return self
     */
	public function run();

    /**
     * @return array
     */
	public function getGameReportAsArray();
}
