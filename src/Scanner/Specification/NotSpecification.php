<?php
namespace Scanner\Specification;

class NotSpecification extends AbstractSpecification implements Specification
{
	/** @var Specification */
	private $specification;

	public function __construct(Specification $specification)
	{
		$this->specification = $specification;
	}

	public function isSatisfiedBy($object)
	{
		return !$this->specification->isSatisfiedBy($object);
	}
}