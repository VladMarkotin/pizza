<?php
namespace App\Facades\Request;


use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\InputBag;

class Request extends SymfonyRequest 
{
    private $postData = [];
    private $getData = [];
    public  InputBag $request;

    public function getDataAsArray() : array
    {
        $content = $this->getContent();
        parse_str($content, $this->postData);
       
        if ($this->postData) {
            return $this->postData;
        }

        return [];
    }

    public function __get($key)
    {
        if ( count($data = $this->getDataAsArray()) ) {
            return $this->getDataAsArray()[$key];
        } 

        return null;
    }
}