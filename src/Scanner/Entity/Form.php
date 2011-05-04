<?php
namespace Scanner\Entity;

use Symfony\Component\DomCrawler\Crawler;

class Form
{
	/** @var Crawler */
	private $crawler;

	/** @var bool */
	private $valid = true;

	public function __construct(Crawler $crawler)
	{
		$this->crawler = $crawler;
	}

	public function getName()
	{
	    return $this->crawler->attr('name');
	}

	public function setValid()
	{
		$this->valid = true;
	}

	public function setInvalid()
	{
		$this->valid = false;
	}

	public function isValid()
	{
		return $this->valid;
	}

	public function filter($selector)
	{
		return $this->crawler->filter($selector);
	}

	/**
	 * Forward calls to Crawler, useful during testing
	 */
	public function __call($method, $args)
	{
		return call_user_func_array(array($this->crawler, $method), $args);
	}
}