<?php
namespace Scanner\Specification;

interface Specification
{
	function isSatisfiedBy($object);
}