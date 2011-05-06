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

	/** @test */
	public function PopsAnElement()
	{
		$collection = new PagesCollection;
		$page1 = new Page('http://example/foo');
		$page2 = new Page('http://example/bar');
		$collection->add($page1);
		$collection->add($page2);

		$this->assertEquals(2, count($collection));
		$this->assertSame($page2, $collection->pop());
		$this->assertEquals(1, count($collection));
		$this->assertSame($page1, $collection->pop());
		$this->assertEquals(0, count($collection));
	}

	/** @test */
	public function ShiftsAnElement()
	{
		$collection = new PagesCollection;
		$page1 = new Page('http://example/foo');
		$page2 = new Page('http://example/bar');
		$collection->add($page1);
		$collection->add($page2);

		$this->assertEquals(2, count($collection));
		$this->assertSame($page1, $collection->shift());
		$this->assertEquals(1, count($collection));
		$this->assertSame($page2, $collection->shift());
		$this->assertEquals(0, count($collection));
	}

	/** @test */
	public function UriDeterminesEquality()
	{
		$collection = new PagesCollection(array(
			$page1 = new Page('http://example/foo'),
			$page2 = new Page('http://example/foo'),
		));

		$collection->add($page1);

		$this->assertTrue($collection->contains($page2), "When a Page with the same URI already exists in the Collection, contains() should return true");
	}


}