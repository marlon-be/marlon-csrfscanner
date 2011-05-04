<?php
namespace Scanner\Entity;

use Scanner\Collection\ArrayCollection;
use Scanner\Collection\Collection;

class Page
{
	private $uri;
	private $title;
	/** @var Collection */
	private $forms;

	public function __construct($uri, $page)
	{
	    $this->uri = $uri;
	    $this->title = $title;
	    $this->forms = new ArrayCollection;
	}

	public function getUri()
	{
	    return $this->uri;
	}

	public function getTitle()
	{
	    return $this->title;
	}

	/** @return Collection */
	public function getForms()
	{
		return $this->forms;
	}

}