<?php
namespace Scanner\Specification;

use Scanner\Entity\Page;

class IsAMailtoLink extends AbstractSpecification implements Specification
{
	public function isSatisfiedBy($page)
	{
		if(!($page instanceof Page)) {
			throw new \InvalidArgumentException('Expected Scanner\Entity\Page');
		}
		return 1 == preg_match('/mailto:/i', $page->getUri());
	}
}