<?php
/**
 * Date: 08/06/2018
 * Time: 16:41
 */

namespace Kolter\CsselectorParser\Tokenizer\Token;


abstract class Token
{
    private $data;

    public  function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return Token
     */
    public function setData(string $data): Token
    {
        $this->data = $data;

        return $this;
    }


}