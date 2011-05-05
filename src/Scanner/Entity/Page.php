<?php
namespace Scanner\Entity;

use Symfony\Component\DomCrawler\Link;

use Scanner\Collection\PagesCollection;
use Goutte\Client;

use Scanner\Collection\FormsCollection;

class Page
{
	/** @var Client */
	private $client;
	private $uri;

	public function __construct($uri)
	{
		$this->uri = $uri;
	}

	public function setClient(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * @return PagesCollection New Collection with all found links
	 */
	public function findLinkedPages()
	{
		$pages = new PagesCollection;

		$crawler = $this->client->request('GET', $this->uri);
		foreach($crawler->filter('a') as $node)
		{
			$link = new Link($node, $this->uri);
			$page = new Page($link->getUri());
			$page->setClient($this->client);
			$pages->add($page);
		}

		return $pages;
	}

	/** @return FormsCollection */
	public function getForms()
	{
		die('@todo');
		$forms = new FormsCollection;
		$this->crawler->filter('form');
		$count = count($crawler);
		for($i = 1; $i <= $count; ++$i) {
			$forms->add(new Form($crawler->eq($i-1)));
		}
		return $forms;
	}

	public function getUri()
	{
		return $this->uri;
	}

}