<?php

namespace TP3;

class POINT
{
    private int $x;
    private int $y;

    private string $couleur;
    public function __construct(int $x, int $y, $couleur)
    {
        $this->x = $x;
        $this->y = $y;
        $this->couleur = $couleur;
    }

    public function distance(POINT $point): float
    {
        return sqrt(($point->x - $this->x)**2 + ($point->y - $this->y)**2);
    }

    public function toString(): string {
        return "($this->x, $this->y) => $this->couleur\n";
    }
}
