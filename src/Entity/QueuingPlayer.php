<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\MatchMaker\Player\PlayerInterface;
use App\Domain\MatchMaker\Player\QueuingPlayer as BaseQueuingPlayer;

/**
 * Class QueuingPlayer
 * @package App\Entity
 * @ORM\Entity
 */
class QueuingPlayer extends BaseQueuingPlayer
{
    public function __construct(PlayerInterface $player, int $idLobby)
    {
        $this->player = $player;
        $this->idLobby = $idLobby;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    public ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $range = 1;

    /**
     * @ORM\OneToOne(targetEntity=Player::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false, referencedColumnName="name")
     */
    public PlayerInterface $player;

    /**
     * @ORM\Column(type="integer")
     */
    public int $idLobby;

}