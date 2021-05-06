<?php


namespace App\twigT;


use App\Entity\Encounter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class EncounterFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('MatchEnCours', [$this, 'matchEnCours']),
            new TwigFilter('MatchTermine', [$this, 'matchTermine'])
        ];
    }

    /**
     * @param array<Encounter> $encounters
     * @return mixed
     */
    public function matchEnCours(array $encounters) {
        return array_filter($encounters, static function(Encounter $encounter) {
            return $encounter->getStatus() === Encounter::STATUS_PLAYING;
        });
    }

    /**
     * @param array<Encounter> $encounters
     * @return mixed
     */
    public function matchTermine(array $encounters) {
        return array_filter($encounters, static function(Encounter $encounter) {
            return $encounter->getStatus() === Encounter::STATUS_OVER;
        });
    }
}