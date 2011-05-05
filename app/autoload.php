<?php

require_once __DIR__.'/../vendor/goutte/autoload.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
	'Scanner'			=> __DIR__.'/../src/',
	'Test'				=> __DIR__.'/../tests/',
	'Symfony'			=> __DIR__.'/../vendor/',
	'Doctrine\Common'	=> __DIR__.'/../vendor/doctrine-common/lib',
));
$loader->register();
