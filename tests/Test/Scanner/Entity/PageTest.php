<?php
namespace Test\Scanner\Entity;

use Scanner\Entity\Page;
use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class PageTest extends TestCase
{
	/** @test */
	public function FindsAllLinkedPages()
	{
		$startpage = $this->getProfile()->getStartPages()->first();

		$linkedpages = $startpage->findLinkedPages();

		$this->assertInstanceOf('Scanner\Collection\PagesCollection', $linkedpages);
		$this->assertEquals(3, count($linkedpages), 'Reading minisite/index.php should find 3 links');
	}
}