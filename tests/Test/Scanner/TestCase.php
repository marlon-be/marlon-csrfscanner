<?php

namespace Test\Scanner;

use Goutte\Client;
use Scanner\Entity\Profile;
use PHPUnit_Framework_TestCase;

require_once 'PHPUnit/Framework/TestCase.php';
require_once __DIR__.'/../../../app/autoload.php';


abstract class TestCase extends PHPUnit_Framework_TestCase
{
	/** @var Profile */
	private $profile;

	/** @return Profile*/
	protected function getProfile()
	{
		if(!isset($this->profile))
		{
			$this->profile = new Profile(new Client);

			// Load Config.php, fall back to Config.php.dist
			$config = __DIR__.'/../../Config.php';
			if(file_exists($config)) {
				require_once $config;
			} else {
				require_once "$config.dist";
			}
			$this->profile->loadFile( __DIR__.'/../../minisite.profile');
		}

		return $this->profile;
	}

	protected function getClient()
	{
		return new Client;
	}

}