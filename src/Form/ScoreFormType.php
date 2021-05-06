<?php


namespace App\Form;

use App\Domain\MatchMaker\Encounter\Score;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoreFormType extends AbstractType
{
    /**
     * ScoreFormType constructor.
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->encounter = $requestStack->getCurrentRequest();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('score', TextType::class)
            ->add('player', EntityType::class, [
                'class' => Player::class,
                'choice_label' => 'name',
                'choices' => [
                  $options['encounter']->playerA,
                  $options['encounter']->playerB,
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class' => Score::class,
            'encounter' => null
        ]);
    }
}