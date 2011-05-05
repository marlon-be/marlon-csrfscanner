<?php
use Goutte\Client;
use Scanner\Application;
use Symfony\Component\Console\Helper\HelperSet;

$version = file_get_contents(__DIR__.'/../VERSION');
$cli = new Application('Csrf Scanner', $version);
$cli->setCatchExceptions(true);
$cli->run();
