<?php
/**
 * Date: 09/06/2018
 * Time: 14:12
 */

namespace Kolter\CsselectorParser\Lexer\Nodes;


class AttributeNode implements Node
{
    /**
     * @var null|string
     */
    private $key = null;
    /**
     * @var null|string
     */
    private $union = null;
    /**
     * @var null|string
     */
    private $value = null;

    /**
     * AttributeNode constructor.
     * @param null $key
     * @param null $union
     * @param $value
     */
    public function __construct(string $key = null, $union = null, $value = null)
    {
        $this->key = $key;
        $this->union = $union;
        $this->value = $value;
    }

    public static function getAttrByString(string $string)
    {
        $result = new AttributeNode();
        $string = str_replace("[","",$string);
        $string = str_replace("]", "", $string);
        $regex = "/(?<key>[^~|^$*=.]{1,}){1,}(?<union>[~|^$*.]{1,})?=?(?<value>.{1,})?/";
        if(preg_match_all($regex,$string,$matches)){
            $result->setKey($matches['key'][0])->setUnion($matches['union'][0])->setValue($matches['value'][0]);
        }
        return $result;
    }



    /**
     * @return null|string
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * @param null|string $key
     * @return AttributeNode
     */
    public function setKey(?string $key): AttributeNode
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getUnion(): ?string
    {
        return $this->union;
    }

    /**
     * @param null|string $union
     * @return AttributeNode
     */
    public function setUnion(?string $union): AttributeNode
    {
        $this->union = $union;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     * @return AttributeNode
     */
    public function setValue(?string $value): AttributeNode
    {
        $this->value = str_replace('"',"",$value);
        return $this;
    }

    public function __toString() : string
    {
        $result = "[".$this->getKey();
        if(!is_null($this->getUnion())) $result.=$this->getUnion();
        if(!is_null($this->getValue())) $result.="=".$this->getValue();

        return $result."]";
    }

}