<?php


namespace App\Controller;

use App\Entity\Encounter;
use App\Form\ScoreFormType;
use App\Repository\EncounterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class home
 * @package App\Controller
 */
class ScoreController extends AbstractController
{
    /**
     * @Route(path="/encounters/{encounter}/score", name="score")
     * @return mixed
     */
    public function __invoke(Encounter $encounter,
                             FormFactoryInterface $formFactory,
                             Request $request,
                             EncounterRepository $encounterRepository, RouterInterface $router) {

        $formBuilder = $formFactory->createBuilder();
        $formBuilder
            ->add(
                'scorePlayer1', ScoreFormType::class, ['encounter' => $encounter]
            )
            ->add(
                'scorePlayer2', ScoreFormType::class, ['encounter' => $encounter]
            )
            ->add(
            'submit', SubmitType::class, ['attr' => ['class' => 'div-valider-score-match']]
            );

        $form = $formBuilder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $valid = true;
            $playersName = [];
            foreach ($form->getData() as $data) {
                $score = $data->score;
                $player = $data->player;
                if (!in_array($player->getName(), $playersName)) {
                    $playersName[] = $player->getName();
                } else {
                    $valid = false;
                }
            }
            if ($valid) {
                $encounter->setScores(...$form->getData());
                $encounter->setStatus(Encounter::STATUS_OVER);

                $encounterRepository->flush();

                return new RedirectResponse($router->generate('home'));
            }
        }

        return $this->render('score/score.html.twig', [
            'encounter' => $encounter,
            'form' => $form->createView()
        ]);
    }
}