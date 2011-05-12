<?php
namespace Scanner\Entity;

use Goutte\Client;
use Symfony\Component\DomCrawler\Link;
use Symfony\Component\DomCrawler\Crawler;
use Scanner\Entity\Form;
use Scanner\Collection\PagesCollection;
use Scanner\Collection\FormsCollection;

class Page
{
	/** @var Client */
	private $client;
	private $uri;

	/** @var Crawler */
	private $crawler;

	public function __construct($uri)
	{
		$this->uri = $this->dropFragment($uri);
	}

	public function setClient(Client $client)
	{
		$this->client = $client;
	}

	public function getCrawler()
	{
		if(!isset($this->crawler)) {
			$this->crawler = $this->client->request('GET', $this->getUri());
		}
		return $this->crawler;
	}

	/**
	 * @return PagesCollection New Collection with all found links
	 */
	public function findLinkedPages()
	{
		$pages = new PagesCollection;

		$crawler = $this->getCrawler();
		foreach($crawler->filter('a') as $node)
		{
			$link = new Link($node, $this->uri);
			$page = new Page($link->getUri());
			$page->setClient($this->client);
			$pages->add($page);
		}

		return $pages;
	}

	/**
	 * Turn a DOMElement into a Scanner\Entity\Form
	 * @return Form
	 */
	private function elementToForm(\DOMElement $node)
	{
		// Find the submit field, or fallback to other submittables
		$formname = sprintf('//form[@name="%s"]', $node->getAttribute('name'));
	 	$query = sprintf(
			'%s//input[@type="submit"] | %s//button | %s//input[@type="button"] | %s//input[@type="image"]',
			$formname, $formname, $formname, $formname
		);

		$xpath = new \DOMXPath($node->ownerDocument);
		$button = $xpath->query($query)->item(0);

		if(!$button)
		{
			// no submit buttons where found, add one ourselves
			$button  = $node->ownerDocument->createElement('input');
			$button->setAttribute('type', 'submit');
			$node->appendChild($button);
		}
		$form = new Form($button, $this->getUri(), 'post');
		return $form;
	}

	/** @return FormsCollection */
	public function getForms()
	{
		$forms = new FormsCollection;
		foreach($this->getCrawler()->filterXPath('//form') as $node)
		{
			if($form = $this->elementToForm($node)) {
				$forms->add($form);
			}
		}
		return $forms;
	}

	public function getUri()
	{
		return $this->uri;
	}

	public function getDomain()
	{
		return parse_url($this->uri, PHP_URL_HOST);
	}

	/**
	 * Removes the part after the #
	 */
	private function dropFragment($uri)
	{
		list($uri) = explode('#', $uri);
		return $uri;
	}
}