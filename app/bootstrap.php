<?php
use Symfony\Component\Console\Application;

$version = file_get_contents(__DIR__.'/../VERSION');
$cli = new Application('Csrf Scanner', $version);
$cli->addCommands(array(
	new \Scanner\Console\ScanCommand,
));
$cli->setCatchExceptions(true);
$cli->run();
