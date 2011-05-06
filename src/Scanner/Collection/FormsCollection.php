<?php
namespace Scanner\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Scanner\Entity\Form;

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
			throw new \InvalidArgumentException("The form must be an instance of Scanner\Entity\Form");
		}
		parent::add($value);
	}
}