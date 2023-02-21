

<?php 


$a = "je suis supérieur à 10 strictement";

if(isset($a) ){
    echo $a ;
}else {
    echo "je suis inférieur à 10 ";
}

echo $a ?? "je suis inférieur à 10 ";
