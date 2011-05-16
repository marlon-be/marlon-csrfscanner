<?php
namespace Test\Scanner\Specification;

use Scanner\Specification\Not;

use Scanner\Specification\Specification;

use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class NotTest extends TestCase
{
	/** @test */
	public function NegatesSpecificationResult()
	{

		$trueSpecification = new MockTrueSpecification;
		$notTrueSpecification = new Not($trueSpecification);
		$this->assertFalse($notTrueSpecification->isSatisfiedBy($this));

		$falseSpecification = new MockFalseSpecification;
		$notFalseSpecification = new Not($falseSpecification);
		$this->assertTrue($notFalseSpecification->isSatisfiedBy($this));
	}
}

class MockTrueSpecification implements Specification
{
	public function isSatisfiedBy($object)
	{
		return true;
	}
}

class MockFalseSpecification implements Specification
{
	public function isSatisfiedBy($object)
	{
		return false;
	}
}