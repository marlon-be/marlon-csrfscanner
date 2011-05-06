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
		// Load config.php, fall back to config.php.dist
		$configfile = __DIR__.'/../../config.php';
		if(file_exists($configfile)) {
			require_once $configfile;
		} else {
			// @codeCoverageIgnoreStart
			$this->fail('This test requires a connection to the minisite. Publish /tests/minisite/ somewhere, copy /tests/config.php.dist to /tests/config.php and adjust it.');
			// @codeCoverageIgnoreEnd
		}

		$this->profile = new Profile(new Client);
		$this->profile->loadFile( __DIR__.'/../../minisite.profile');

		$this->client = new Client;
	}

}