<?php
namespace Scanner\Entity;

class Form
{
	/** @var Page */
	private $page;

	private $name;

	public function __construct(Page $page, $name)
	{
		$this->page = $page;
		$this->name = $name;
	}

	public function getPage()
	{
	    return $this->page;
	}

	public function getName()
	{
	    return $this->name;
	}
}