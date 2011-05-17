<?php
namespace Scanner\Specification;

class OrSpecification extends AbstractSpecification implements Specification
{
	/** @var Specification */
	private $left;

	/** @var Specification */
	private $right;

	public function __construct(Specification $left, Specification $right)
	{
		$this->left = $left;
		$this->right = $right;
	}

	public function isSatisfiedBy($object)
	{
		return $this->left->isSatisfiedBy($object) || $this->right->isSatisfiedBy($object);
	}
}