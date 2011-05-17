<?php
namespace Test\Scanner\Specification;

use Scanner\Specification\AbstractSpecification;
use Scanner\Specification\NotSpecification;
use Scanner\Specification\AndSpecification;
use Scanner\Specification\OrSpecification;
use Scanner\Specification\Specification;

use Test\Scanner\TestCase;

require_once __DIR__.'/../TestCase.php';

class BooleanSpecificationsTest extends TestCase
{
	/** @var MockSpecification */
	private $truemock;

	/** @var MockSpecification */
	private $falsemock;

	public function setUp()
	{
		$this->truemock = new MockSpecification(true);
		$this->falsemock = new MockSpecification(false);
	}

	/** @test */
	public function NotSpecification()
	{
		$not = new NotSpecification($this->truemock);
		$this->assertFalse($not->isSatisfiedBy(new \stdClass));

		$not = new NotSpecification($this->falsemock);
		$this->assertTrue($not->isSatisfiedBy(new \stdClass));
	}


	/** @test */
	public function AndSpecification()
	{
		$and = new AndSpecification($this->falsemock, $this->falsemock);
		$this->assertFalse($and->isSatisfiedBy(new \stdClass));
		$and = new AndSpecification($this->truemock, $this->falsemock);
		$this->assertFalse($and->isSatisfiedBy(new \stdClass));
		$and = new AndSpecification($this->falsemock, $this->truemock);
		$this->assertFalse($and->isSatisfiedBy(new \stdClass));
		$and = new AndSpecification($this->truemock, $this->truemock);
		$this->assertTrue($and->isSatisfiedBy(new \stdClass));
	}

	/** @test */
	public function OrSpecification()
	{
		$and = new OrSpecification($this->falsemock, $this->falsemock);
		$this->assertFalse($and->isSatisfiedBy(new \stdClass));
		$and = new OrSpecification($this->truemock, $this->falsemock);
		$this->assertTrue($and->isSatisfiedBy(new \stdClass));
		$and = new OrSpecification($this->falsemock, $this->truemock);
		$this->assertTrue($and->isSatisfiedBy(new \stdClass));
		$and = new OrSpecification($this->truemock, $this->truemock);
		$this->assertTrue($and->isSatisfiedBy(new \stdClass));
	}

	/** @test */
	public function FluentInterface()
	{
		$this->assertTrue(
			$this->truemock
				->and_($this->truemock)
				->isSatisfiedBy(new \stdClass)
		);

		$this->assertFalse(
			$this->falsemock
				->or_($this->falsemock)
				->isSatisfiedBy(new \stdClass)
		);

		$this->assertTrue(
			$this->falsemock->not_()
				->and_(
					$this->falsemock->or_($this->truemock)
				)
				->and_(
					$this->truemock
				)
				->isSatisfiedBy(new \stdClass)
		);
	}
}

class MockSpecification extends AbstractSpecification implements Specification
{
	private $result;
	public function __construct($result)
	{
		$this->result = $result;
	}
	public function isSatisfiedBy($object)
	{
		return $this->result;
	}
}
