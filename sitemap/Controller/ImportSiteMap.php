<?php

namespace Snowdog\SiteMap\Controller;

use Snowdog\DevTest\Model\PageManager;
use Snowdog\DevTest\Model\WebsiteManager;
use Snowdog\DevTest\Model\UserManager;
use Snowdog\SiteMap\Core\XmlManager;
use Snowdog\SiteMap\Core\Validator;
use Snowdog\DevTest\Controller\BaseController;

class ImportSiteMap extends BaseController{
	
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
        $this->filter('auth');
        
        $this->websiteManager = $websiteManager;
        $this->pageManager = $pageManager;
        $this->xmlManager = $xmlManager;
        $this->userManager = $userManager;
    }

    public function execute()
    {
        
        $name = $_POST['name'];
        $file = $_FILES['sitemap'];

        if(!empty($name) && Validator::not_empty($file) ) {
            $validXmlEtension = $this->xmlManager->validExtension($file['name']);
            if($validXmlEtension)
            {
                if (isset($_SESSION['login'])) {
                    $user = $this->userManager->getByLogin($_SESSION['login']);
                    if ($user) {

                        $this->xmlManager->importFile($file['tmp_name']);

                        if($this->xmlManager->siteMapWrap())
                        {
                            $webSiteUrl = $this->xmlManager->getWebSiteUrl();

                            $webSiteName = trim($name);

                            $lastInsertId = $this->websiteManager->create($user, $webSiteName, $webSiteUrl);

                            $website = $this->websiteManager->getById($lastInsertId);

                            $pageCounter = ($website) ? $this->xmlManager->createPages($website, $this->pageManager) : 0;

                            $_SESSION['flash'] = "Import SiteMap done. <strong>Website id: {$lastInsertId}. Count imported pages: {$pageCounter} </strong>";
                        }
                    }
                }
            }else{
                $_SESSION['flash'] = 'Zły format pliku!';    
            }
        } else {
            $_SESSION['flash'] = 'Brak pliku lub błąd uploadu!';
        }
        header('Location: /sitemap');
    }
}