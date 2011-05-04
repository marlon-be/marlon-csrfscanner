<?php
namespace Test\Scanner;

require_once 'PHPUnit/Framework/TestCase.php';
require_once __DIR__.'/../../../app/autoload.php';

use Scanner\Entity\Profile;

class TestCase extends \PHPUnit_Framework_TestCase
{
	/** @return Profile*/
	protected function getProfile()
	{
		$profile = new Profile;

		// Load samplesite.profile, fall back to samplesite.profile.dist
		$sampleprofile = __DIR__.'/../../samplesite.profile';
		if(file_exists($sampleprofile)) {
			$profile->loadFile($sampleprofile);
		} else {
			$profile->loadFile("$sampleprofile.dist");
		}

		return $profile;
	}
}