<?php
use Scanner\Application;
use Symfony\Component\Console\Helper\HelperSet;

$helperSet = new HelperSet;
$version = file_get_contents(__DIR__.'/../VERSION');
$cli = new Application('Csrf Scanner', $version);
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);
$cli->run();
