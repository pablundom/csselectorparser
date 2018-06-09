<?php
/**
 * Date: 08/06/2018
 * Time: 16:58
 */

namespace Kolter\CsselectorParser\Tokenizer\Stream;



interface Stream
{

    public function __construct(InputStream $inputStream);

    public function startCondition() : bool;

    public function endCondition() : bool;

    public function read() : array;
}