<?php
namespace Test\Scanner\Entity;

use Scanner\Entity\Page;
use Test\Scanner\ProfileTestCase;

require_once __DIR__.'/../ProfileTestCase.php';

class PageTest extends ProfileTestCase
{
	/** @test */
	public function FindsAllLinkedPages()
	{
		$startpage = $this->profile->getStartPages()->first();

		$linkedpages = $startpage->findLinkedPages();

		$this->assertInstanceOf('Scanner\Collection\PagesCollection', $linkedpages);
		$this->assertEquals(3, count($linkedpages), 'Reading minisite/index.php should find 3 links');
	}
}