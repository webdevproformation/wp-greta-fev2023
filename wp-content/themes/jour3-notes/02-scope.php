<?php 

$a = 10 ; // portée 
// que les variables dans la fonction


function calcul(){
    global $a ;
    $a = 50 ; 
    return $a * 2 ;
}

