<?php
namespace Test\Scanner\Specification;

use Scanner\Entity\Page;
use Scanner\Specification\IsAMailtoLink;
use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class IsAMailtoLinkTest extends TestCase
{
	/** @test */
	public function MatchesMailtoLinks()
	{
		$specification = new IsAMailtoLink;
		$page1 = new Page('http://foobar/mailto:test@example');
		$page2 = new Page('mailto:test@example');

		$this->assertTrue($specification->isSatisfiedBy($page1));
		$this->assertTrue($specification->isSatisfiedBy($page2));
	}

	/** @test */
	public function DoesNotMatchNormalLinks()
	{
		$specification = new IsAMailtoLink;
		$page = new Page('http://foobar/');

		$this->assertFalse($specification->isSatisfiedBy($page));
	}

}