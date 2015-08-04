<?php
namespace Test\Scanner\Collection;

use Scanner\Collection\FormsCollection;
use Test\Scanner\TestCase;

class FormsCollectionTest extends TestCase
{
	/** @test */
	public function AcceptsForms()
	{
		$collection = new FormsCollection(array(
			$this->getMock('Scanner\Entity\Form', array(), array(), 'SomeForm', false)
		));
	}
}