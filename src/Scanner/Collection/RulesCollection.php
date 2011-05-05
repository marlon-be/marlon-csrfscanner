<?php
namespace Scanner\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Scanner\Rule\Rule;

class RulesCollection extends ArrayCollection
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
		if(!$value instanceof Rule)
		{
			throw new \InvalidArgumentException("The rule must be an instance of Scanner\Rule\Rule");
		}
		parent::add($value);
	}
}