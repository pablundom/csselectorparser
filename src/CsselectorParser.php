<?php
/**
 * Date: 10/06/2018
 * Time: 17:31
 */

namespace Kolter\CsselectorParser;


use Kolter\CsselectorParser\Lexer\Lexer;
use Kolter\CsselectorParser\Tokenizer\Stream\InputStream;
use Kolter\CsselectorParser\Tokenizer\Stream\TokenStream;

class CsselectorParser
{

    private $selector;

    public function __construct(string $query)
    {
        $this->selector = $query;
    }

    public function parse() : array
    {
        $inputStream = new InputStream($this->selector);
        $tokenStream = new TokenStream($inputStream);
        $tokens = $tokenStream->read();
        $lexer = new Lexer($tokens);

        return $lexer->evaluate();
    }
}