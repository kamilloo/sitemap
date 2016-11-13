<?php

namespace Snowdog\SiteMap\Core;

use Snowdog\DevTest\Model\PageManager;
use Snowdog\DevTest\Model\Website;

class XmlManager{

	const REGULAR_VALID = '/^.*\.xml$/i';

	private $xml;
	private $webSiteUrl;
	private $webSiteName;
	private $pageUrls;
    private  $pageCounter;

	public function __construct()
	{
		$this->xml = $this->webSiteUrl = $this->webSiteName = null;
		$this->pageUrls = [];
        $this->pageCounter = 0;
	}
	
	public function validXML($xmlFile)
	{
		if(empty($xmlFile)) return false;

		if(!file_exists($xmlFile)) return false;

        if(!$this->validExtension($xmlFile)) return false;

		return true;
	}

    public function validExtension($fileName)
    {
        if(!preg_match(self::REGULAR_VALID,$fileName)) return false;

        return true;
    }

    public function importFile($xmlFile)
    {
	 	$xmlstr = file_get_contents($xmlFile);
        $this->xml = new \SimpleXMLElement($xmlstr);
    }

    public function siteMapWrap()
    {  
	    if(!isset($this->xml->url)) return false;
	    return count($this->xml->url);
    }

    public function getWebSiteUrl()
    {
    	if(!$this->siteMapWrap()) return false;

    	$urlWrap = $this->xml->url;

    	$this->webSiteName = (string)$urlWrap->loc;
        $this->webSiteUrl = parse_url($this->webSiteName, PHP_URL_HOST);


    	unset($this->xml->url[0]);
    	
    	return $this->webSiteUrl;
    }

    public function getPageUrls()
    {
    	if(!$this->siteMapWrap()) return false;
    	if(is_null($this->webSiteUrl))$this->getWebSiteUrl();

    	foreach($this->xml->url as $url)
    		$this->addPageUrl($url);

    	return $this->pageUrls;
    }

    private function addPageUrl($urlWrap)
    {
    	$page = trim(parse_url((string)$urlWrap->loc, PHP_URL_PATH),'/');
    	if(!in_array($page, $this->pageUrls))
    		$this->pageUrls[] = $page;
    }

    public function getWebSiteName()
    {
    	return $this->webSiteName;
    }

    public function getWebSite()
    {
    	return $this->webSiteUrl;
    }

    public function createPages(Website $website, PageManager $pageManager)
    {

        $pages = $this->getPageUrls();

        foreach ($pages as $page) {
            $lastPageId = $pageManager->create($website, $page);
            if($lastPageId) $this->pageCounter += 1;
        }
        
        
        return $this->pageCounter;
    }

                   


}
