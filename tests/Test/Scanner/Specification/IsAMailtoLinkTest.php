<?php
namespace Test\Scanner\Specification;

use Scanner\Entity\Page;
use Scanner\Specification\IsAMailtoLinkSpecification;
use Test\Scanner\TestCase;

class IsAMailtoLinkSpecificationTest extends TestCase
{
	/** @test */
	public function MatchesMailtoLinks()
	{
		$specification = new IsAMailtoLinkSpecification;
		$page1 = new Page('http://foobar/mailto:test@example');
		$page2 = new Page('mailto:test@example');

		$this->assertTrue($specification->isSatisfiedBy($page1));
		$this->assertTrue($specification->isSatisfiedBy($page2));
	}

	/** @test */
	public function DoesNotMatchNormalLinks()
	{
		$specification = new IsAMailtoLinkSpecification;
		$page = new Page('http://foobar/');

		$this->assertFalse($specification->isSatisfiedBy($page));
	}

}