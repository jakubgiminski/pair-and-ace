<?php

namespace App\Game;

use App\Player\PlayerContract;
use App\GameLog\GameLogContract;
use App\Dice\DiceContract;

class Game implements GameContract
{
    protected $log;

    protected $players = [];

    protected $dices = [];

    protected $winner = null;

    protected $roundLimit = 100;

    protected $gameRun = false;

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
        return $this->thereIsAPair($result) and $this->thereIsOneBesidesThePair($result);
    }

    private function thereIsAPair(array $result)
    {
        return $result != array_unique($result);
    }

    private function thereIsOneBesidesThePair(array $result)
    {
        $arrayValues = array_count_values($result);

        if (isset($arrayValues[1])) {
            return $arrayValues[1] == 1 or $arrayValues[1] == 3;
        }

        return false;
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

    public function getGameReportAsArray()
    {
        return $this->log->getReportAsArray();
    }

    private function guardAgainstNoDices()
    {
        if (empty($this->dices)) {
            throw new \Exception('The game can\'t run with no dices! Add dices first.');
        }
    }

    private function guardAgainstNoPlayers()
    {
        if (empty($this->players)) {
            throw new \Exception('The game can\'t run with no players! Add players first.');
        }
    }

    private function guardAgainsMultipleGameRuns()
    {
        if ($this->gameRun) {
            throw new \Exception('One instance of the Game can only run once. Create new instance.');
        }
    }
}
