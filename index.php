<?php



include "vendor/autoload.php";


$query = "p#lol.papa[value|=lol][jiji^=pepe]>jiji.lol#pepe";
$css = new \Kolter\CsselectorParser\CsselectorParser($query);

$css =$css->parse()[0];

echo $css;
