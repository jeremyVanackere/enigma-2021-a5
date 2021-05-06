<?php
declare(strict_types=1);

namespace App\Controller;

use App\MatchMaker\Lobby as LobbyService;
use App\MatchMaker\LobbyRapide as LobbyRapideService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class home
 * @package App\Controller
 * @Route(path="/home", name="home")
 */
FINAL class Home extends AbstractController
{
    public function __invoke(LobbyService $lobbyPrincipale,
                             LobbyRapideService $lobbyRapide) {
        return $this->render('home/home.html.twig', [
            'lobbyPrincipale' => $lobbyPrincipale,
            'lobbyRapide' => $lobbyRapide,
        ]);
    }
}