<?php

use Snowdog\SiteMap\Command\SitemapCommand;
use Snowdog\SiteMap\Controller\ImportSiteMap;
use Snowdog\SiteMap\Controller\SiteMapForm;
use Snowdog\SiteMap\Menu\SiteMapMenu;

use Snowdog\DevTest\Component\CommandRepository;
use Snowdog\DevTest\Component\Menu;
use Snowdog\DevTest\Component\RouteRepository;

RouteRepository::registerRoute('POST', '/sitemap', ImportSiteMap::class, 'execute');
RouteRepository::registerRoute('GET', '/sitemap', SiteMapForm::class, 'execute');
CommandRepository::registerCommand('sitemap [xmlFile]', SitemapCommand::class);

Menu::register(SiteMapMenu::class, 10);