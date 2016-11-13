<?php

namespace Snowdog\DevTest\filter;

class Auth{

	public function __construct()
	{
	    if (!isset($_SESSION['login'])) {
        	header('Location: /login');
        }
	}
	    
}