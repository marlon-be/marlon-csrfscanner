<?php
namespace Scanner\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Scanner\Entity\Page;

class PagesCollection extends ArrayCollection
{
	public function __construct(array $elements = array())
	{
		foreach($elements as $element) {
			$this->add($element);
		}
	}

    public function add($value)
    {
    	if(!$value instanceof Page)
		{
			throw new \InvalidArgumentException("The page must be an instance of Scanner\Entity\Page");
		}

        $this[$value->getUri()] = $value;
        return true;
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