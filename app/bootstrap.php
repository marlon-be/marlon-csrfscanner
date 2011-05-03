#!/usr/bin/env php
<?php
use Scanner\Application;
use Symfony\Component\Console\Helper\HelperSet;

$helperSet = new HelperSet;
$cli = new Application('Csrf Scanner', '0.1');
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);
$cli->run();
