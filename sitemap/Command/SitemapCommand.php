<?php

namespace Snowdog\SiteMap\Command;

use Snowdog\DevTest\Model\PageManager;
use Snowdog\DevTest\Model\WebsiteManager;
use Snowdog\DevTest\Model\UserManager;
use Snowdog\SiteMap\Core\XmlManager;
use Symfony\Component\Console\Output\OutputInterface;

class SitemapCommand
{
    /**
     * @var WebsiteManager
     */
    private $websiteManager;
    /**
     * @var PageManager
     */
    private $pageManager;
    
    /**
    * @var XMLManager
     */
    private $xmlManager;
    /**
    * @var UserManager
     */
    private $userManager;

    public function __construct(WebsiteManager $websiteManager, PageManager $pageManager, XmlManager $xmlManager, UserManager $userManager)
    {
        $this->websiteManager = $websiteManager;
        $this->pageManager = $pageManager;
        $this->xmlManager = $xmlManager;
        $this->userManager = $userManager;
    }

    public function __invoke($xmlFile, OutputInterface $output)
    {
        $validXml = $this->xmlManager->validXml($xmlFile);
        if($validXml)
        {
            try{

                $this->xmlManager->importFile($xmlFile);

                $demoUser = $this->userManager->getByLogin('demo');

                if($this->xmlManager->siteMapWrap())
                {
                    $webSiteUrl = $this->xmlManager->getWebSiteUrl();

                    $webSiteName = $this->xmlManager->getWebSiteName();

                    $lastInsertId = $this->websiteManager->create($demoUser, $webSiteName, $webSiteUrl);

                    $website = $this->websiteManager->getById($lastInsertId);

                    $pageCounter = ($website) ? $this->xmlManager->createPages($website, $this->pageManager) : 0;

                } 

                $output->writeln("Import SiteMap done. <info>Website id: {$lastInsertId}. Count imported pages: {$pageCounter} </info>");

            }catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }else
        {
            $output->writeln('<error>Brak lub zły format pliku</error>');
        }
    }
}