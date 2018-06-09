<?php


namespace Kolter\CsselectorParser\Tokenizer\Stream;


use Kolter\Collections\Collections;
use Kolter\CsselectorParser\Tokenizer\Token\AttributeToken;
use Kolter\CsselectorParser\Tokenizer\Token\ElementToken;
use Kolter\CsselectorParser\Tokenizer\Token\UnionToken;
use Kolter\Htmlparser\Tokenizer\Token\ClosedTagToken;
use Kolter\Htmlparser\Tokenizer\Token\TagToken;


class AttributeStream implements Stream
{

    private $inputStream;

    public function __construct(InputStream $inputStream)
    {
        $this->inputStream = $inputStream;
    }

    public function startCondition() : bool
    {
        $char = $this->inputStream->peek();

        return $char==="[";
    }

    public function endCondition() : bool
    {
        $char = $this->inputStream->peek();

        return $char==="]";
    }

    public function read() : array
    {
        $result = Collections::newArrayList();
        $content = '';
        while($this->endCondition()===false){
            $content.= $this->inputStream->next();
        }
        $content=$content."]";
        $result[] = new AttributeToken($content);
        return $result->reverse()->getElements();

    }
}