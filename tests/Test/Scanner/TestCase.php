<?php
namespace Test\Scanner;

require_once 'PHPUnit/Framework/TestCase.php';
require_once __DIR__.'/../../../app/autoload.php';

use Scanner\Entity\Profile;

class TestCase extends \PHPUnit_Framework_TestCase
{
	/** @var Profile */
	private $profile;

	/** @return Profile*/
	protected function getProfile()
	{
		if(!isset($this->profile))
		{
			$this->profile = new Profile;

			// Load samplesite.profile, fall back to samplesite.profile.dist
			$sampleprofile = __DIR__.'/../../samplesite.profile';
			if(file_exists($sampleprofile)) {
				$this->profile->loadFile($sampleprofile);
			} else {
				$this->profile->loadFile("$sampleprofile.dist");
			}

		}

		return $this->profile;
	}
}