<?php
namespace Test\Scanner\Collection;

use Scanner\Collection\RulesCollection;

use Test\Scanner\TestCase;

class RulesCollectionTest extends TestCase
{
	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function OnlyAcceptsRules()
	{
		$collection = new RulesCollection(array(
			new \stdClass
		));
	}
}