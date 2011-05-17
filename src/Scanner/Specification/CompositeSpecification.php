<?php
namespace Scanner\Specification;

/**
 * Useful to make Specifications that consist of other Specifications. Override the constructor
 * <code>
 * public function __construct()
 * {
 * 		$this->specifications = array(new FooSpecification, new BarSpecification)
 * }
 * </code>
 * Enter description here ...
 * @author mathiasverraes
 *
 */
abstract class CompositeSpecification extends AbstractSpecification implements Specification
{
	private $specifications = array();

	public function isSatisfiedBy($object)
	{
		foreach($this->specifications as $specification)
		{
			if(!$specification->isSatisfiedBy($object)) {
				return false;
			}
			return true;
		}
	}
}