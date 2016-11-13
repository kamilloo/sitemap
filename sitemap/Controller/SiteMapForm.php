<?php

namespace Snowdog\SiteMap\Controller;

use Snowdog\DevTest\Controller\BaseController;

class SiteMapForm extends BaseController{

	public function __construct()
    {
        $this->filter('auth');        
    }

	public function execute() {
        require __DIR__ . '/../view/sitemap.phtml';
    }
}