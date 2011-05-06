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
		$indexpage = $this->profile->getStartPages()->first();

		$linkedpages = $indexpage->findLinkedPages();

		$this->assertInstanceOf('Scanner\Collection\PagesCollection', $linkedpages);
		$this->assertEquals(3, count($linkedpages), 'Reading minisite/index.php should find 3 links');
	}

	/** @test */
	public function FindsAllForms()
	{
		$allpages = $this->profile->spider();
		$allpages->pop();
		$goodformpage = $allpages->pop(); // we know that goodform.php is the one-to-last in the list

		$foundforms = $goodformpage->getForms();

		$this->assertInstanceOf('Scanner\Collection\FormsCollection', $foundforms);
		$this->assertEquals(2, count($foundforms));
	}
}