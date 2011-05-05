<?php
namespace Test\Scanner\Collection;

use Scanner\Entity\Form;
use Scanner\Collection\FormsCollection;
use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class FormsCollectionTest extends TestCase
{
	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function OnlyAcceptsForms()
	{
		$collection = new FormsCollection(array(
			new \stdClass
		));
	}

	/** @test */
	public function AcceptsForms()
	{
		$collection = new FormsCollection(array(
			$this->getMock('Scanner\Entity\Form', array(), array(), 'SomeForm', false)
		));
	}
}