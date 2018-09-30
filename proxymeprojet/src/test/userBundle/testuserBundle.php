<?php

namespace test\userBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class testuserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }



}
