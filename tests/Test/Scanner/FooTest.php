<?php
namespace Test\Scanner;

use Symfony\Component\DomCrawler\Link;

use Test\Scanner\TestCase;
use Goutte\Client;

require_once __DIR__.'/TestCase.php';


class FooTest extends TestCase
{
	/** @test */
	public function Foo()
	{
		$client = new Client;
		$uri = 'http://localhost:8888/csrfscan-minisite/';
		$crawler = $client->request('GET', $uri);
		foreach($crawler->filter('a') as $node)
		{
			$link = new Link($node, $uri);
			var_dump($link->getUri());
		}
	}
}