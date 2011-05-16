<?php
namespace Test\Scanner\Specification;

use Scanner\Entity\Page;

use Scanner\Specification\NotAMailtoLink;
use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class NotAMailtoLinkTest extends TestCase
{
	/** @test */
	public function DoesNotMatchMailtoLinks()
	{
		$specification = new NotAMailtoLink;
		$page1 = new Page('http://foobar/mailto:test@example');
		$page2 = new Page('mailto:test@example');

		$this->assertFalse($specification->isSatisfiedBy($page1));
		$this->assertFalse($specification->isSatisfiedBy($page2));
	}

	/** @test */
	public function MatchesNormalLinks()
	{
		$specification = new NotAMailtoLink;
		$page = new Page('http://foobar/');

		$this->assertTrue($specification->isSatisfiedBy($page));
	}

}