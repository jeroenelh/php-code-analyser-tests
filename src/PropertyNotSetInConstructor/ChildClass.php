<?php

namespace App\PropertyNotSetInConstructor;

class ChildClass extends MainClass
{
    public function __construct()
    {
        $this->uninitialized = 2;

        parent::__construct();
    }
}
