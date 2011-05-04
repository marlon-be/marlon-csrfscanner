<?php
namespace Scanner\Entity;

use Scanner\Collection\FormCollection;

class Page
{
	private $uri;
	private $title;
	/** @var FormCollection */
	private $forms;

	public function __construct($uri, $title)
	{
	    $this->uri = $uri;
	    $this->title = $title;
	    $this->forms = new FormCollection;
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