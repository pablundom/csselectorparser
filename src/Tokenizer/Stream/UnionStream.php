<?php


namespace Kolter\CsselectorParser\Tokenizer\Stream;


use Kolter\Collections\Collections;
use Kolter\CsselectorParser\Tokenizer\Token\ElementToken;
use Kolter\CsselectorParser\Tokenizer\Token\UnionToken;
use Kolter\Htmlparser\Tokenizer\Token\ClosedTagToken;
use Kolter\Htmlparser\Tokenizer\Token\TagToken;


class UnionStream implements Stream
{

    private $inputStream;

    public function __construct(InputStream $inputStream)
    {
        $this->inputStream = $inputStream;
    }

    public function startCondition() : bool
    {
        $char = $this->inputStream->peek();

        return preg_match("/[ ,>+~]/",$char)===1;
    }

    public function endCondition() : bool
    {
        $char = $this->inputStream->peek();

        return preg_match("/[ ,>+~]/",$char)!==1;
    }

    public function read() : array
    {
        $result = Collections::newArrayList();
        $content = '';
        while($this->endCondition()===false){
            $content.= $this->inputStream->next();
        }
        $content = trim($content);
        $content = ($content==="") ? $content = " " : $content;
        $result[] = new UnionToken($content);
        return $result->reverse()->getElements();

    }
}