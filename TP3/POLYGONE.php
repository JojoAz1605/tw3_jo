<?php

namespace TP3;

class POLYGONE
{
    private array $points;

    public function __construct(array $points)
    {
        $this->points = $points;
    }

    public function nombre_sommets(): int {
        return sizeof($this->points);
    }

    public function perimetre(): float {
        $res = 0;
        for ($i = 0; $i < $this->nombre_sommets(); $i++) {
            if ($i+1 < $this->nombre_sommets()) {
                $res += $this->points[$i]->distance($this->points[$i+1]);
            } else {
                $res += $this->points[$i]->distance($this->points[0]);
            }
        }
        return $res;
    }

    public function toString(): string {
        $res = "";
        for ($i = 0; $i < $this->nombre_sommets(); $i++) {
            $res .= $this->points[$i]->toString();
        }
        return $res . "\n";
    }
}
