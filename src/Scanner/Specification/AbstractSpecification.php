<?php
namespace Scanner\Specification;

abstract class AbstractSpecification implements Specification
{
	public function and_(Specification $other)
	{
		return new AndSpecification($this, $other);
	}

	public function or_(Specification $other)
	{
		return new OrSpecification($this, $other);
	}

	public function not_()
	{
		return new NotSpecification($this);
	}
}