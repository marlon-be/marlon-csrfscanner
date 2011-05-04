<?php
namespace Scanner\Entity;

use Scanner\Exception\FileNotFoundException;

class Profile
{
	private $domain;

	public function loadFile($filename)
	{
		if(!file_exists($filename)) {
			throw new FileNotFoundException("Profile not found: $filename");
		}
		include $filename;
	}

	public function getDomain()
	{
		return $this->domain;
	}

	public function setDomain($domain)
	{
		$this->domain = $domain;
	}
}