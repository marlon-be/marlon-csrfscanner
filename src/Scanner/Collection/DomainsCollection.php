<?php
namespace Scanner\Collection;

use Doctrine\Common\Collections\ArrayCollection;

class DomainsCollection extends ArrayCollection
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
        return $this->set($value, $value);
    }

    public function set($key, $value)
    {
		return parent::set($key, $value);
    }
}