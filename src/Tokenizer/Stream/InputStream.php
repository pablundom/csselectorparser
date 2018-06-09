<?php

namespace Kolter\CsselectorParser\Tokenizer\Stream;

class InputStream
{
    private $position = 0;
    private $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function next()
    {
        $character = substr($this->string,$this->position,1);
        $this->position++;

        return $character;
    }

        public function previous()
    {
            $character = substr($this->string,$this->position-1,1);
            $this->position--;

            return $character;
    }

    public function advance(int $times) : string
    {
        foreach (range(0,$times) as $value){
            $this->next();
        }

        return $this->peek();
    }

    public function eof()
    {
        return strlen($this->string)<=$this->position;
    }

    public function peek(int $charNumber=1)
    {
        return substr($this->string,$this->position,$charNumber);
    }

    public function peekMore(int $times)
    {
        return substr($this->string,$this->position+$times,1);
    }

    public function getPosition() : int
    {
        return $this->position;
    }

    public function setPosition(int $position)
    {
        $this->position = $position;
    }

    public function getString()
    {
        return $this->string;
    }

    public function length()
    {
        return strlen($this->string);
    }

}