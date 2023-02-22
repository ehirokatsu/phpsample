<?php

namespace App\Http\Services;
use App\Http\Services\HelloService2;

class HelloService
{
    public $foo;
    public $helloService2;
/*
    public function __construct(HelloService2 $helloService2)
    {
        $this->helloService2 = $helloService2;
    }
*/
    public function echo()
    {
        //return $helloService2->echo2();
        return 'hoge';
    }
}

?>