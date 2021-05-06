<?php

namespace App\MatchMaker;

use App\Domain\MatchMaker\Player\InLobbyPlayerInterface;
use App\Domain\MatchMaker\Player\PlayerInterface;
use App\Entity\QueuingPlayer;
use App\Repository\EncounterRepository;
use App\Repository\QueuingPlayerRepository;
use App\Domain\MatchMaker\Lobby as BaseLobby;
use App\Entity\Encounter as EntityEncounter;

class LobbyRapide extends BaseLobby
{

    private string $name;
    private int $date;
    private int $multiplicateurPoint;
    private int $id;

    /**
     * Lobby constructor.
     * @param iterable $queuingPlayers
     * @param iterable $encounters
     */
    public function __construct(private QueuingPlayerRepository $queuingPlayerRepository,private EncounterRepository $encounterRepository)
    {
        $this->id = 2;
        $this->name = "Lobby rapide";
        $this->multiplicateurPoint = 3;
        $this->date = 0;
        $this->queuingPlayers = $queuingPlayerRepository->findBy(['idLobby'=>$this->id]);
        $this->encounters = $encounterRepository->findAll();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * @param int $date
     */
    public function setDate(int $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getMultiplicateurPoint(): int
    {
        return $this->multiplicateurPoint;
    }

    /**
     * @param int $multiplicateurPoint
     */
    public function setMultiplicateurPoint(int $multiplicateurPoint): void
    {
        $this->multiplicateurPoint = $multiplicateurPoint;
    }

    public function addPlayer(PlayerInterface $player): void
    {
        $queuingPlayer = new QueuingPlayer($player, $this->id);
        $this->queuingPlayerRepository->persist(
            $queuingPlayer
        );
        $this->queuingPlayerRepository->flush();
        $this->queuingPlayers[] = new QueuingPlayer($player, $this->id);
    }

    public function createEncounterForPlayer(InLobbyPlayerInterface $player): void
    {
        parent::createEncounterForPlayer($player);

        foreach ($this->encounters as $key => $encounter) {
            if (!($encounter instanceof EntityEncounter)) {
                $entityEncounter = new EntityEncounter();
                $entityEncounter->playerA = $encounter->playerA;
                $entityEncounter->playerB = $encounter->playerB;
                $this->encounterRepository->persist($entityEncounter);
                $this->encounters[$key] = $entityEncounter;
            }
        }

        $this->encounterRepository->flush();
    }

    public function removePlayer(PlayerInterface $player): void
    {
        try {
            $queuingPlayer = $this->isInLobby($player);
            $this->queuingPlayerRepository->remove($queuingPlayer);
        } catch (NotFoundPlayersException $exception) {
            throw new \Exception('You cannot remove a player that is not in the lobby.', 128, $exception);
        }

        parent::removePlayer($player);
    }
}
