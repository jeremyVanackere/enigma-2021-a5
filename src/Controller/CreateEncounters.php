<?php


namespace App\Controller;


use App\MatchMaker\EncounterCreator;
use App\Repository\EncounterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class CreateEncounters
 * @package App\Controller
 * @Route("/lobby/create_encounters", name="create_encounters")
 */
class CreateEncounters extends AbstractController
{
    public function __invoke(EncounterCreator $encounterCreator)
    {

        $encounters = $encounterCreator->createEncounters();

        dd($encounters);

        return $this->render('encouters/encouters.html.twig', [
            'controller_name' => 'CreateEncounters',
            'encounters' => $encounters
        ]);
    }
}