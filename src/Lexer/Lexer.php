<?php

namespace Kolter\CsselectorParser\Lexer;


use Kolter\Collections\ArrayList;
use Kolter\CsselectorParser\Lexer\Nodes\ElementNode;
use Kolter\CsselectorParser\Tokenizer\Token\AttributeToken;
use Kolter\CsselectorParser\Tokenizer\Token\ElementToken;
use Kolter\CsselectorParser\Tokenizer\Token\SelectorToken;
use Kolter\CsselectorParser\Tokenizer\Token\Token;
use Kolter\CsselectorParser\Tokenizer\Token\UnionToken;


class Lexer
{

    /**
     * @var Token[]
     */
    private $tokens;

    public function __construct(array $tokens)
    {
        $this->tokens = $tokens;
    }

    public function evaluate() : array
    {
        $result = new ArrayList();
        $lastUnion = null;
        $lastElement = null;
        foreach ($this->tokens as $value){
            if($value instanceof ElementToken or $value instanceof SelectorToken or $value instanceof AttributeToken){
                if(is_null($lastElement)){
                    $lastElement = new ElementNode();
                    $lastElement->parseSelector($value->getData());
                    $result[] = $lastElement;
                    continue;
                }
                if(is_null($lastUnion)){
                    $lastElement->parseSelector($value->getData());
                    continue;
                }
                $element = new ElementNode();
                $element->parseSelector($value->getData());
                $element->setParent($lastElement);
                $lastElement->setChildrenUnionType($lastUnion);
                $lastUnion = null;
                $lastElement->setChildren($element);
                $lastElement = $element;
                continue;
            }
            if($value instanceof UnionToken){
                $lastUnion = $value->getData();
            }
        }

        return $result->getElements();
    }


}