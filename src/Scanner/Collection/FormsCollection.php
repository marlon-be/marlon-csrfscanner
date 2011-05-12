<?php
namespace Scanner\Collection;

use Scanner\Entity\Form;
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

	private function check(Form $value)
	{
		// empty, the type hinting will check if $value is a Page instance
	}

    public function add($value)
    {
    	// make sure forms are unique
        return $this->set($value->getHash(), $value);
    }

    public function set($key, $value)
    {
    	$this->check($value);
		return parent::set($key, $value);
    }


}