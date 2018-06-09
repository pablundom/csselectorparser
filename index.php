<?php


use Kolter\CsselectorParser\Lexer\Lexer;
use Kolter\CsselectorParser\Tokenizer\Stream\InputStream;
use Kolter\CsselectorParser\Tokenizer\Stream\TokenStream;

include "vendor/autoload.php";

$time_start = microtime(true);
$query = "p::after.class[name|=pepe][class=lol]  .lol[lang.=en]:before";
$is = new InputStream($query);
$ts = new TokenStream($is);

$ts->read();

$tokens = $ts->getTokens();

$ls = new Lexer($tokens);

$array = $ls->evaluate();

$ele = $array[0];
$time_end = microtime(true);
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo ''.$execution_time.' Mins';
var_dump($ele);

