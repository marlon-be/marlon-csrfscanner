<?php
namespace Scanner\Specification;

use Scanner\Entity\Page;

interface PageSpecification
{
	function isSatisfiedBy(Page $page);
}