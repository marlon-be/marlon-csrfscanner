<?php
namespace Scanner\Specification;

interface Specification
{
	/** @return bool */
	function isSatisfiedBy($object);

	/**
	 * The method is has an underscore because 'and' is reserved
	 * @return AndSpecification
	 */
	function and_(Specification $specification);

	/**
	 * The method is has an underscore because 'or' is reserved
	 * @return OrSpecification
	 */
	function or_(Specification $specification);

	/**
	 * The method is has an underscore for consistency with 'and_' and 'or_'
	 * @return NotSpecification
	 */
	function not_();
}