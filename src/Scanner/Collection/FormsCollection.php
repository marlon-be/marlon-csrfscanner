<?php
namespace Scanner\Collection;

use Scanner\Entity\Form;

class FormsCollection extends ArrayCollection
{
	public function add($value)
	{
		if(!$value instanceof Form)
		{
			throw new \InvalidArgumentException("The rule must be an instance of Scanner\Entity\Form");
		}
		parent::add($value);
	}
}