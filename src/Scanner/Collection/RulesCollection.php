<?php
namespace Scanner\Collection;

use Scanner\Rule\Rule;

class RulesCollection extends ArrayCollection
{
	public function __construct(array $elements = array())
	{
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