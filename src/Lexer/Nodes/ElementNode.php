<?php
/**
 * Date: 09/06/2018
 * Time: 14:12
 */

namespace Kolter\CsselectorParser\Lexer\Nodes;


class ElementNode extends NodeAbstract
{
    private $classes = [];
    private $id = null;
    private $tag = null;
    private $pseudoSelector = null;
    private $children = null;
    private $childrenUnionType = null;
    private $parent = null;
    private $attrs = [];

    public function parseSelector(string $selector) : ElementNode
    {
        $firstChar = substr($selector,0,1);
        switch ($firstChar){
            case '#':
                $this->setId(substr($selector,1));
                break;
            case '.':
                $this->addClass(substr($selector,1));
                break;
            case ':':
                $pseudo = substr($selector,1);
                $this->setPseudoSelector($pseudo);
                break;
            case "[":
                $attr = AttributeNode::getAttrByString($selector);
                $this->addAttr($attr);
                break;
        }

        return $this;
        }

    private function addClass(string $substr) : ElementNode
    {
        $this->classes[] = $substr;

        return $this;
    }


     /**
     * @return array
     */
    public function getClasses(): array
    {
        return $this->classes;
    }

    /**
     * @param array $classes
     */
    public function setClasses(array $classes): void
    {
        $this->classes = $classes;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param null $tag
     */
    public function setTag($tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @return null
     */
    public function getPseudoSelector()
    {
        return $this->pseudoSelector;
    }

    /**
     * @param null $pseudoSelector
     */
    public function setPseudoSelector($pseudoSelector): void
    {
        $this->pseudoSelector = $pseudoSelector;
    }

    /**
     * @return array
     */
    public function getChildren(): ElementNode
    {
        return $this->children;
    }

    /**
     * @param array $childrens
     * @return ElementNode
     */
    public function setChildren(ElementNode $children): ElementNode
    {
        $this->children = $children;
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
     * @return ElementNode
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    private function addAttr(AttributeNode $attr)
    {
        $this->attrs[] = $attr;
    }

    /**
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * @param array $attrs
     * @return ElementNode
     */
    public function setAttrs(array $attrs): ElementNode
    {
        $this->attrs = $attrs;
        return $this;
    }

    /**
     * @return null
     */
    public function getChildrenUnionType()
    {
        return $this->childrenUnionType;
    }

    /**
     * @param null $childrenUnionType
     */
    public function setChildrenUnionType($childrenUnionType): void
    {
        $this->childrenUnionType = $childrenUnionType;
    }


}