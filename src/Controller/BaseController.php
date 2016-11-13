<?php 

namespace Snowdog\DevTest\Controller;

use Snowdog\DevTest\Filter\Auth;

class BaseController{

	/**
	* @var filter
	*/
	protected $filter;

	
	protected function filter($filter)
	{
		$class = 'Snowdog\DevTest\Filter\\'.ucfirst($filter);
		$this->filter = new $class;
	}


}