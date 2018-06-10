<?php
/**
 * Date: 08/06/2018
 * Time: 16:33
 */

namespace Kolter\CsselectorParser\Tokenizer\Stream;

use Kolter\Collections\Collections;



class TokenStream
{

    private $tokens;
    private $inputStream;

    public function __construct(InputStream $inputStream)
    {
        $this->inputStream = $inputStream;
        $this->tokens = Collections::newArrayList();
    }

    public function read(): array
    {
        $streams = $this->getStreams();
        while(!$this->inputStream->eof()){
            $checked = false;
            foreach ($streams as $val){
                if($val->startCondition()){
                    $tokens = $val->read();
                    $this->tokens->addAll($tokens);
                    $checked = true;
                }
            }
            if($checked) continue;
            $this->inputStream->next();
        }

        return $this->tokens->all();

    }

    public function getTokens() : array
    {
        return $this->tokens->getElements();
    }

    private function getStreams()
    {
        $result = [];
        $streams = [ElementStream::class,UnionStream::class,AttributeStream::class];
        foreach ($streams as $value){
            $result[] = new $value($this->inputStream);
        }

        return $result;
    }


}