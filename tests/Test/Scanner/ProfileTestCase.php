<?php

namespace Test\Scanner;

use Goutte\Client;
use Scanner\Entity\Profile;
use Config;

require_once __DIR__.'/TestCase.php';

abstract class ProfileTestCase extends TestCase
{
	/** @var Profile */
	protected $profile;

	/** @var Client */
	protected $client;

	public function setUp()
	{
		$profilefile =  __DIR__.'/../../minisite.profile';
		if(!file_exists($profilefile)) {
			// @codeCoverageIgnoreStart
			$this->fail('This test requires a connection to the minisite. Publish /tests/minisite/ somewhere, copy /tests/minisite.profile.dist to /tests/minisite.profile and adjust it.');
			// @codeCoverageIgnoreEnd
		}

		$this->profile = new Profile(new Client);
		$this->profile->loadFile($profilefile);

		$this->client = new Client;
	}

}