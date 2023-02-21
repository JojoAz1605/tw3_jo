<?php
$dicoprix=array("jambon"=>3,"saucetomate"=>1.5,'poivrons'=>2,'oignons'=>1,"champignons"=>2,"mozarella"=>1.5, "cremefraiche"=>1.5,"chevre"=>2,"tomates"=>2,"lardons"=>2.5,'saumon'=>4,'merguez'=>3);

function combien($dico) {return sizeof($dico);}

function prix_moyen($dico) {
    $total = 0;
    foreach ($dico as $key => $value) {$total += $value;}
    return round($total / combien($dico), 2);
}

function moins_cher($dico) {

}

function dollars($dico) {
    foreach ($dico as $key => $value) {
        $dico[$key] = $value * 1.12;
    }
}

echo combien($dicoprix);
echo "\n";
echo prix_moyen($dicoprix);
echo "\n";
// echo moins_cher($dicoprix);
echo "\n";
dollars($dicoprix);
echo prix_moyen($dicoprix);
