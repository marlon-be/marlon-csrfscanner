<?php
namespace Scanner\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Scanner\Entity\Page;

class PagesCollection extends ArrayCollection
{
	public function __construct(array $elements = array())
	{
		parent::__construct();
		foreach($elements as $element) {
			$this->add($element);
		}
	}

	private function check(Page $value)
	{
		// empty, the type hinting will check if $value is a Page instance
	}

    public function add($value)
    {
        return $this->set($value->getUri(), $value);
    }

    public function set($key, $value)
    {
    	$this->check($value);
		return parent::set($key, $value);
    }

    public function shift()
    {
		$element = $this->first();
		$this->removeElement($element);
		return $element;
    }

    public function pop()
    {
		$element = $this->last();
		$this->removeElement($element);
		return $element;
    }

	public function contains($element)
    {
        return parent::contains($element) || parent::containsKey($element->getUri());
    }
}