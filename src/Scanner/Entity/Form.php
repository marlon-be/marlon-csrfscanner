<?php
namespace Scanner\Entity;

use Symfony\Component\DomCrawler\Form as CrawlerForm;

class Form
{
	/** @var Symfony\Component\DomCrawler\Form */
	private $crawlerform;

	/** @var bool */
	private $valid = true;

	public function __construct(CrawlerForm $crawlerform)
	{
		$this->crawlerform = $crawlerform;
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

	/**
	 * Forward calls to Symfony\Component\DomCrawler\Form
	 */
	public function __call($method, $args)
	{
		return call_user_func_array(array($this->crawlerform, $method), $args);
	}
}