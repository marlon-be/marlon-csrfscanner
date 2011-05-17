<?php
namespace Scanner\Specification;

use Scanner\Collection\PagesCollection;

use Scanner\Entity\Page;

/**
 * NOTE: This returns true if the Page is blacklisted. Use a NotSpecification to invert
 */
class BlacklistedPageSpecification extends AbstractSpecification implements Specification
{
	/** @var PagesCollection */
	private $blacklist;

	public function __construct(PagesCollection $blacklist)
	{
		$this->blacklist = $blacklist;
	}

	public function isSatisfiedBy($page)
	{
		if(!($page instanceof Page)) {
			throw new \InvalidArgumentException('Expected Scanner\Entity\Page');
		}

		return $this->blacklist->contains($page);
	}
}