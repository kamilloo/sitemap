<?php

namespace Snowdog\SiteMap\Menu;

use Snowdog\DevTest\Menu\AbstractMenu;


class SiteMapMenu extends AbstractMenu
{

    public function isActive()
    {
        return $_SERVER['REQUEST_URI'] == '/sitemap';
    }

    public function getHref()
    {
        return '/sitemap';
    }

    public function getLabel()
    {
        return 'SiteMap';
    }
    public function __invoke()
    {
        if (isset($_SESSION['login'])) {
            parent::__invoke();
        }
    }
}