<?php

namespace Snowdog\DevTest\Controller;

class RegisterFormAction extends BaseController
{
	public function __construct()
    {
        $this->filter('guest');
    }
    
    public function execute() {
        require __DIR__ . '/../view/register.phtml';
    }
}