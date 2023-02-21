<?php

include_once("POINT.php");
include_once("POLYGONE.php");
use TP3\POINT;
use TP3\POLYGONE;

$p1 = new POINT(5, 5, "red");
$p2 = new POINT(6, 6, "blue");
$p3 = new POINT(5, 6, "blue");
$p4 = new POINT(6, 5, "blue");

$poly1 = new POLYGONE(array($p1, $p2, $p3, $p4));

echo $p1->toString();
echo $p2->toString();
echo $p3->toString();
echo $p4->toString() . "\n";

echo $poly1->toString();

echo $p1->distance($p2) . "\n";
echo $poly1->nombre_sommets();
echo $poly1->perimetre();
