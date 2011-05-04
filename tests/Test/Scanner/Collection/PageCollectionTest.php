<?php
namespace Test\Scanner\Collection;
use Scanner\Entity\Page;
use Scanner\Collection\PageCollection;
use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class PageCollectionTest extends TestCase
{
	/** @test */
	public function PagesCanOnlyBeAddedOnce()
	{
		$collection = new PageCollection;
		$page1 = new Page('http://example/foo', 'foo title');
		$page2 = new Page('http://example/foo', 'foo2 title');
		$page3 = new Page('http://example/bar', 'bar title');

		$collection->add($page1);
		$collection->add($page1); // add it twice
		$collection->add($page2);
		$collection->add($page3);

		$this->assertEquals(2, count($collection));
	}
}