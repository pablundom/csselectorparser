<?php
/**
 * Date: 09/06/2018
 * Time: 14:12
 */

namespace Kolter\CsselectorParser\Lexer\Nodes;


abstract class NodeAbstract implements Node
{

    private $name;
    private $parent;

    public function __construct(string $name=null, $parent = null)
    {
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return NodeAbstract
     */
    public function setName(string $name): NodeAbstract
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param null $parent
     * @return NodeAbstract
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }


}