<?php
namespace Scanner\Entity;

use Scanner\Collection\FormsCollection;

use Symfony\Component\DomCrawler\Crawler;

class Page
{
	/** @var Crawler */
	private $crawler;
	private $uri;

	public function __construct($uri, Crawler $crawler)
	{
		$this->uri = $uri;
	    $this->crawler = $crawler;
	}

	/** @return FormsCollection */
	public function getForms()
	{
		$forms = new FormsCollection;
		// find all forms and put them in a FormCollection
		$crawler = $this->crawler->filter('form');
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