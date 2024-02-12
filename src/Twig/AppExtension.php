<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter(name: 'Taille', callable: [$this, 'getLength']),
        ];
    }

    public function getFunctions(): array
    {
        return [ new TwigFunction(name: 'addition', callable: [$this, 'CalculAdd']),
        ];
    }

    public function getLength(array $tableau)
    {
       return count($tableau);
    }

    public function CalculAdd(int $chiffre1, int $chiffre2)
    {
        return $chiffre1 + $chiffre2;
    }
   
}
