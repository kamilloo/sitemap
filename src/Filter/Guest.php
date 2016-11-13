<?php

namespace Snowdog\DevTest\Filter;

use Snowdog\DevTest\Exception\HTTP_403;

class Guest{

	public function __construct()
	{		
		try{

			if (isset($_SESSION['login'])) {
        		throw new HTTP_403('Access Forbidden', 403);
        	}
        
		} catch (HTTP_403 $e)
		{
        	echo $e->getExceptionView();
        	exit;
        }
	}
}