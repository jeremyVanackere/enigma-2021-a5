<?php

namespace App\Entity;

use App\Repository\EncounterRepository;
use Doctrine\ORM\Mapping as ORM;
use \App\Domain\MatchMaker\Encounter\Encounter as EncounterBase;
use \App\Domain\MatchMaker\Player\PlayerInterface as PlayerInterface;

/**
 * @ORM\Entity(repositoryClass=EncounterRepository::class)
 */
class Encounter extends EncounterBase
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $dateOfEncounter;

    /**
     * @ORM\Column()
     */
    protected string $status = self::STATUS_PLAYING;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    public ?float $scorePlayerA = null;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    public ?float $scorePlayerB = null;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(referencedColumnName="name")
     */
    public ?PlayerInterface $playerA = null;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class)
     * @ORM\JoinColumn(referencedColumnName="name")
     */
    public ?PlayerInterface $playerB = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
