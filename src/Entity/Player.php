<?php


namespace App\Entity;

use App\Domain\MatchMaker\Player\Player as BasePlayer;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Player
 * @package App\Entity
 * @ORM\Entity
 */
class Player extends BasePlayer
{
    /**
     * @ORM\Id
     * @ORM\Column
     */
    protected string $name;
    /**
     * @ORM\Column(type="float")
     */
    protected float $ratio;
}