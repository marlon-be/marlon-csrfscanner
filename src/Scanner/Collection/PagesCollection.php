<?php
namespace Scanner\Collection;

use Scanner\Entity\Page;

class PagesCollection extends ArrayCollection
{
    public function add($value)
    {
    	if(!$value instanceof Page)
		{
			throw new \InvalidArgumentException("The page must be an instance of Scanner\Entity\Page");
		}

        $this->_elements[$value->getUri()] = $value;
        return true;
    }

    public function pop()
    {
		$element = $this->last();
		$this->removeElement($element);
		return $element;
    }
}