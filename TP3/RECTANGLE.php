<?php

namespace TP3;

class RECTANGLE extends POLYGONE
{
    public function __construct(POINT $p1, POINT $p2)
    {
        parent::__construct(array($p1, $p2));
    }

    public function longueur(): int {
        return $this
    }
}