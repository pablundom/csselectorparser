<?php


use Kolter\CsselectorParser\Lexer\Lexer;
use Kolter\CsselectorParser\Tokenizer\Stream\InputStream;
use Kolter\CsselectorParser\Tokenizer\Stream\TokenStream;

include "vendor/autoload.php";


$query = "p";
$css = new \Kolter\CsselectorParser\CsselectorParser($query);

var_dump($css->parse());

