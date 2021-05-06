<?php


namespace App\MatchMaker;

use App\Repository\EncounterRepository;

class EncounterCreator
{
    public  function __construct(private Lobby $lobby, private EncounterRepository $encounterRepository) {

    }

    public function createEncounters() {
        $this->lobby->createEncounters();
        $this->encounterRepository->flush();
        return $this->lobby->encounters;
    }
}