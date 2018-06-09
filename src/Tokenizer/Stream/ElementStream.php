<?php


namespace Kolter\CsselectorParser\Tokenizer\Stream;


use Kolter\Collections\Collections;
use Kolter\CsselectorParser\Tokenizer\Token\ElementToken;
use Kolter\Htmlparser\Tokenizer\Token\ClosedTagToken;
use Kolter\Htmlparser\Tokenizer\Token\TagToken;


class ElementStream implements Stream
{

    private $inputStream;
    private $startChar;

    public function __construct(InputStream $inputStream)
    {
        $this->inputStream = $inputStream;
        $this->startChar = 1;
    }

    public function startCondition() : bool
    {
        $char = $this->inputStream->peek();
        $chars = $this->inputStream->peek(2);
        if($chars==="::"){
            $this->startChar = 2;
            return true;
        }
        return preg_match("/[a-zA-Z.#:]/",$char)===1;
    }

    public function endCondition() : bool
    {
        $char = $this->inputStream->peekMore(0);

        return preg_match("/[a-zA-Z]/",$char)!==1;
    }

    public function read() : array
    {
        $result = Collections::newArrayList();
        $content= '';
        foreach (range(0,$this->startChar-1) as $value){
            $content.=$this->inputStream->next();
        }
        while($this->endCondition()===false){
            $content.= $this->inputStream->next();
        }

        $result[] = new ElementToken($content);
        return $result->reverse()->getElements();

    }
}