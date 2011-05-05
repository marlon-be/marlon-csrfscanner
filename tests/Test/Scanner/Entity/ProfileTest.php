<?php
namespace Test\Scanner\Entity;

use Scanner\Entity\Profile;
use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class ProfileTest extends TestCase
{
	/** @test */
	public function LoadingAProfilePopulatesAttributes()
	{
		$profile = $this->getProfile();

		$this->assertInstanceOf('Scanner\Collection\PagesCollection', $profile->getStartpages());
		$this->assertEquals(1, count($profile->getStartpages()));
		$this->assertInstanceOf('Scanner\Collection\RulesCollection', $profile->getRules());
		$this->assertEquals(1, count($profile->getRules()));
		$this->assertAttributeInstanceOf('Goutte\Client', 'client', $profile);
	}

	/** @test */
	public function SpidersAllPagesInASite()
	{
		$profile = $this->getProfile();
		$this->assertEquals(4, count($profile->getAllPages()));
	}
}