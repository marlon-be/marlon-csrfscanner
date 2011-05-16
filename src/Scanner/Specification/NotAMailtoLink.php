<?php
namespace Scanner\Specification;

use Scanner\Entity\Page;

class NotAMailtoLink implements PageSpecification
{
	public function isSatisfiedBy(Page $page)
	{
		// we don't just want to match valid emailwant to match everything here that vaguely
		return 0 == preg_match('/mailto:/i', $page->getUri());
	}
}