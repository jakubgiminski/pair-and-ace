<?php

namespace App\Game;

use App\Player\PlayerContract;
use App\GameLog\GameLogContract;
use App\Dice\DiceContract;

class Game implements GameContract
{
    /** @var GameLogContract */
    protected $log;

    /** @var array */
    protected $players = [];

    /** @var array */
    protected $dices = [];

    /** @var null|PlayerContract */
    protected $winner = null;

    /** @var int */
    protected $roundLimit = 100;

    /** @var bool */
    protected $gameRun = false;

    /**
     * @param GameLogContract $log
     */
    public function __construct(GameLogContract $log)
    {
        $this->log = $log;
    }

    /**
     * @param PlayerContract $player
     * @return self
     */
    public function addPlayer(PlayerContract $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * @param array $players
     * @return self
     */
    public function addPlayers(array $players)
    {
        foreach ($players as $player) {
            $this->addPlayer($player);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param DiceContract $dice
     * @return self
     */
    private function addDice(DiceContract $dice)
    {
        $this->dices[] = $dice;

        return $this;
    }

    /**
     * @param array $dices
     * @throws \InvalidArgumentException
     * @return self
     */
    public function addDices(array $dices)
    {
        if (count($dices) !== 3) {
            throw new \InvalidArgumentException('You can only add three dices for this game to make sense.');
        }

        foreach ($dices as $dice) {
            $this->addDice($dice);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getDices()
    {
        return $this->dices;
    }

    /**
     * @param array $result
     * @return bool
     */
    public function isResultWinnig(array $result)
    {
        return $this->thereIsAPair($result) and $this->thereIsOneBesidesThePair($result);
    }

    /**
     * @param array $result
     * @return bool
     */
    private function thereIsAPair(array $result)
    {
        return $result != array_unique($result);
    }

    /**
     * @param array $result
     * @return bool
     */
    private function thereIsOneBesidesThePair(array $result)
    {
        $arrayValues = array_count_values($result);

        if (isset($arrayValues[1])) {
            return $arrayValues[1] == 1 or $arrayValues[1] == 3;
        }

        return false;
    }

    /**
     * @param PlayerContract $player
     */
    public function setWinner(PlayerContract $player)
    {
        $this->winner = $player;
    }

    /**
     * @return Player|null
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @return bool
     */
    public function thereIsNoWinner()
    {
        return $this->winner == null;
    }

    /**
     * @return self
     */
    public function run()
    {
        $this->guardAgainstNoDices();
        $this->guardAgainstNoPlayers();
        $this->guardAgainsMultipleGameRuns();

        $this->log->gameStarts();
        $roundCount = 1;

        while ($this->thereIsNoWinner()) {
            if ($roundCount > $this->roundLimit) {
                $this->log->nobodyWins();
                break;
            }

            $this->log->newRoundStarts($roundCount);

            foreach ($this->players as $player) {
                $result = $player->rollDices($this->dices);
                $this->log->playerRollsDices($player->getName(), $result);

                if ($this->isResultWinnig($result)) {
                    $this->setWinner($player);
                    $this->log->playerWins($player->getName());
                    break;
                }
            }

            $roundCount++;
        }

        $this->log->gameEnds();
        $this->gameRun = true;

        return $this;
    }

    /**
     * @throws \Exception
     * @return array
     */
    public function getGameReportAsArray()
    {
    	if (!$this->gameRun) {
    		throw new \Exception('Cannot get report for a game, that didn\'t run yet.');
    	}

        return $this->log->getReportAsArray();
    }

    /**
     * @throws \Exception
     */
    private function guardAgainstNoDices()
    {
        if (empty($this->dices)) {
            throw new \Exception('The game can\'t run with no dices! Add dices first.');
        }
    }

    /**
     * @throws \Exception
     */
    private function guardAgainstNoPlayers()
    {
        if (empty($this->players)) {
            throw new \Exception('The game can\'t run with no players! Add players first.');
        }
    }

    /**
     * @throws \Exception
     */
    private function guardAgainsMultipleGameRuns()
    {
        if ($this->gameRun) {
            throw new \Exception('One instance of the Game can only run once. Create new instance.');
        }
    }
}
