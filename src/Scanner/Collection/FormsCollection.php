<?php
namespace Scanner\Collection;

use Symfony\Component\DomCrawler\Form;
use Doctrine\Common\Collections\ArrayCollection;

class FormsCollection extends ArrayCollection
{
	public function __construct(array $elements = array())
	{
		parent::__construct();
		foreach($elements as $element) {
			$this->add($element);
		}
	}

	public function add($value)
	{
		if(!$value instanceof Form)
		{
			throw new \InvalidArgumentException("The form must be an instance of Symfony\Component\DomCrawler\Form");
		}
		parent::add($value);
	}
}