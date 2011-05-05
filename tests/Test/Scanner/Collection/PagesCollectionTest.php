<?php
namespace Test\Scanner\Collection;
use Scanner\Entity\Page;
use Scanner\Collection\PagesCollection;
use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class PagesCollectionTest extends TestCase
{
	/** @test */
	public function PagesCanOnlyBeAddedOnce()
	{
		$collection = new PagesCollection;
		$page1 = new Page('http://example/foo');
		$page2 = new Page('http://example/foo');
		$page3 = new Page('http://example/bar');

		$collection->add($page1);
		$collection->add($page1); // add it twice
		$collection->add($page2);
		$collection->add($page3);

		$this->assertEquals(2, count($collection));
	}
}