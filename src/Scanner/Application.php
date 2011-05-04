<?php
namespace Scanner;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
	public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
	{
		parent::__construct($name, $version);

        $this->addCommands(array(
            new \Scanner\Console\ScanCommand,
        ));
	}
}
