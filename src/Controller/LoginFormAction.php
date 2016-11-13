<?php

namespace Snowdog\DevTest\Controller;

class LoginFormAction extends BaseController
{
	public function __construct()
    {
        $this->filter('guest');
    }
    public function execute()
    {
        require __DIR__ . '/../view/login.phtml';
    }
}