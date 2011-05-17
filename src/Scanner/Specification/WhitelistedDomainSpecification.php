<?php
namespace Scanner\Specification;

use Scanner\Collection\DomainsCollection;
use Scanner\Entity\Page;

class WhitelistedDomainSpecification extends AbstractSpecification implements Specification
{
	/** @var DomainCollection */
	private $whitelist;

	public function __construct(DomainsCollection $whitelist)
	{
		$this->whitelist = $whitelist;
	}

	public function isSatisfiedBy($page)
	{
		if(!($page instanceof Page)) {
			throw new \InvalidArgumentException('Expected Scanner\Entity\Page');
		}

		return $this->whitelist->contains($page->getDomain());
	}
}