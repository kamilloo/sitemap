<?php

namespace Snowdog\DevTest\Exception;

class HTTP_403 extends \Exception{

	public function __construct($message, $code = 0, Exception $previous = null) {
      
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function getExceptionView()
    {
        require  __DIR__ . '/../view/403.phtml';
    }
	
}