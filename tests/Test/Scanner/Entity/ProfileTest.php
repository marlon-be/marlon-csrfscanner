<?php
namespace Test\Scanner\Entity;

use Scanner\Entity\Profile;
use Test\Scanner\ProfileTestCase;

require_once __DIR__.'/../ProfileTestCase.php';

class ProfileTest extends ProfileTestCase
{
	/** @test */
	public function LoadingAProfilePopulatesAttributes()
	{
		$this->assertInstanceOf('Scanner\Collection\PagesCollection', $this->profile->getStartpages());
		$this->assertEquals(1, count($this->profile->getStartpages()));
		$this->assertInstanceOf('Scanner\Collection\RulesCollection', $this->profile->getRules());
		$this->assertEquals(2, count($this->profile->getRules()));
		$this->assertAttributeInstanceOf('Goutte\Client', 'client', $this->profile);
	}

	/** @test */
	public function SpidersAllPagesInASite()
	{
		$this->assertEquals(5, count($this->profile->spider()));
	}
}