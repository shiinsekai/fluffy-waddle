<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class ShiinsekaiPlayer
 * @package Hackathon\PlayerIA
 * @author Quang Nghi Huynh
 */
class ShiinsekaiPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        $opponentChoices = $this->result->getChoicesFor($this->opponentSide);
        $isBastard = true;
        $isHappyNiceGuy = true;
        $threshold = 10;
        $lastResults = count($opponentChoices) - 10;
        $niceGuy = true;

        $dream_team = array('PacoTheGreat', 'FelixDupriez', 'Ghope', 'Etienneelg', 'Christaupher', 'Benli06');

        $oppName = $this->result->getStatsFor($this->opponentSide)['name'];
                if (in_array($oppName, $dream_team))
                    return parent::friendChoice();

        for ($i = 0; $i < count($opponentChoices); ++$i) {
            if ($opponentChoices[$i] == 'friend') {
                $isBastard = false;
            }
            if ($opponentChoices[$i] == 'foe') {
                $isHappyNiceGuy = false;
            }

            if ($i >= $lastResults && $opponentChoices[$i] == 'foe') {
                $niceGuy = false;
            }
        }

        if ($this->result->getNbRound() == 0) {
            return parent::foeChoice();
        }

        if ($isBastard == true && $this->result->getNbRound() >= $threshold) {
            return parent::foeChoice();
        }

        if ($isHappyNiceGuy == true && $this->result->getNbRound() >= $threshold) {
            return parent::friendChoice();
        }

        if ($niceGuy == true) {
            return parent::friendChoice();
        }

        if ($this->result->getLastScoreFor($this->opponentSide) == 'friend') {
            return parent::friendChoice();
        }
        return parent::friendChoice();
    }
 
};
