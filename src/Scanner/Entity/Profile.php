<?php
namespace Scanner\Entity;

use Scanner\Collection\PagesCollection;

use Goutte\Client;

use Scanner\Exception\FileNotFoundException;

class Profile
{
	private $domain;

	public function loadFile($filename)
	{
		if(!file_exists($filename)) {
			throw new FileNotFoundException("Profile not found: $filename");
		}
		include $filename;
	}

	public function setDomain($domain)
	{
		$this->domain = $domain;
	}

	/** @return PagesCollection */
	public function getPages()
	{
		$client = new Client;
		$pages = new PagesCollection;
		$uri = $this->domain.'/goodform.php';
		$pages->add(new Page($uri, $client->request('GET', $uri)));
		$uri = $this->domain.'/notokenform.php';
		$pages->add(new Page($uri, $client->request('GET', $uri)));
		$uri = $this->domain.'/tokennotcheckedform.php';
		$pages->add(new Page($uri, $client->request('GET', $uri)));
		return $pages;
	}
}