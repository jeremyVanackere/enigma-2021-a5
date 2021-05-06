<?php

namespace App\Controller;

use App\Domain\Exceptions\NotFoundPlayersException;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use \App\MatchMaker\Lobby as LobbyService;
use \App\MatchMaker\LobbyRapide as LobbyRapideService;

class LobbyController extends AbstractController
{
    #[Route('/lobby/principale', name: 'lobbyPrincipale')]
    public function lobbyPrincipale(LobbyService $lobby, UserInterface $user)
    {
        /**
         * @var User $user
         */
        try {
            !$lobby->isInLobby($user->getPlayer());
        } catch(NotFoundPlayersException) {
            if (!$lobby->isPlaying($user->getPlayer())) {
                $lobby->addPlayer($user->getPlayer());
            }
        }

        return $this->render('lobby/lobby.html.twig', [
            'controller_name' => 'LobbyController',
            'lobby' => $lobby
        ]);
    }

    #[Route('/lobby/rapide', name: 'lobbyRapide')]
    public function lobbyRapide(LobbyRapideService $lobby, UserInterface $user)
    {
        /**
         * @var User $user
         */
        try {
            !$lobby->isInLobby($user->getPlayer());
        } catch(NotFoundPlayersException) {
            if (!$lobby->isPlaying($user->getPlayer())) {
                $lobby->addPlayer($user->getPlayer());
            }
        }

        return $this->render('lobby/lobby.html.twig', [
            'controller_name' => 'LobbyController',
            'lobby' => $lobby
        ]);
    }
}
