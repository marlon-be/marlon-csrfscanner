<?php

namespace Test\Scanner;

use Goutte\Client;
use Scanner\Entity\Profile;
use Config;

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
			$profilefile = __DIR__.'/../../minisite.profile.dist';
		}
		if(!file_exists($profilefile)) {
			// @codeCoverageIgnoreStart
			$this->fail('This test requires a connection to the minisite. Publish /tests/minisite/ somewhere, copy /tests/minisite.profile.dist to /tests/minisite.profile and adjust it.');
			// @codeCoverageIgnoreEnd
		}

		$this->client = new Client;
		$this->profile = new Profile($this->client);
		$this->profile->loadFile($profilefile);

	}

}